var devArt = angular.module('devArt', ['ngCookies'], ['$interpolateProvider', '$httpProvider', '$locationProvider', function ($interpolateProvider, $httpProvider, $locationProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $httpProvider.defaults.headers.common['X-Requested-With'] = "XMLHttpRequest";
    $httpProvider.defaults.headers.post['X-CSRF-Token'] = $('meta[name=_token]').attr('content');

    $locationProvider.html5Mode(true);
    $locationProvider.hashPrefix('!');
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]);
//Global Controller for Global Changes
devArt.controller('AppController', function () {
    this.isBookmakrShow = false;
    this.isCategoryShow = false;
    this.setIsBookmarkShow = function () {
        this.isBookmarkShow = !this.isBookmarkShow;
    };
    this.setIsCategoryShow = function (element) {
        this.isCategoryShow = !this.isCategoryShow;
    };
    this.hideSidebar = function () {
        this.isBookmarkShow = false;
        this.isCategoryShow = false;
    };
    this.stopProp = function ($event) {
        $event.stopPropagation();
    };
});


devArt.controller('ViewTypeController', ['$scope', 'viewTypeService', '$cookieStore', function ($scope, viewTypeService, $cookieStore) {
    this.changeView = function (setView) {
        viewTypeService.view = setView;
        $cookieStore.put('viewType', setView);
    };
    this.isSelected = function (checkView) {
        return viewTypeService.view === checkView;
    };
}]);
//setting view type to grid if not defined
devArt.service('viewTypeService', ['$cookieStore', function($cookieStore) {
    this.view =  (typeof $cookieStore.get('viewType') === "undefined") ? 'large' :
            $cookieStore.get('viewType');
}]);
devArt.directive('viewDirective', [ 'viewTypeService', function(viewTypeService) {
    return {
        link : function( scope, element, attr) {
            var article = element.find('div.article');
            var header = element.find('.article-header');
            var parent = element.closest('div.body-width');
            element.hover(function() {
                header.addClass('dark-blue');
            }, function() {
                header.removeClass('dark-blue')
            })
            scope.$watch(function(){
                return viewTypeService.view;
            }, function (newValue) {
                if (newValue == 'list') {
                    article.addClass('article-list').removeClass('article-grid');
                    element.addClass('col-lg-10 col-lg-offset-1').removeClass('col-lg-3');
                    parent.addClass('container').removeClass('container-fluid body-width');
                }
                else {
                    article.addClass('article-grid').removeClass('article-list');
                    element.addClass('col-lg-3').removeClass('col-lg-10 col-lg-offset-1');
                    parent.removeClass('container ').addClass('container-fluid body-width');
                }                
            });
        }
    };
}]);
devArt.service('searchService', [function() {
    this.results = [];
    this.selectedElement = [];
}]);

devArt.controller('SearchController', ['$scope', '$http', 'searchService', function ($scope, $http, searchService) {
    var index = -1,
        self = this,
        container = $('.searchResults'),
        inputBox  = $('#searchInputBox');

    $scope.searchInput = '';
    $scope.results = [];
    $scope.selectedElement = false;
    $scope.specialKeys = false;
    this.showResults = false;

    $(document).on('click', function (e)
    {
        $scope.$apply(function() {
            if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0 // ... nor a descendant of the container
                && !inputBox.is(e.target))
            {
                self.showResults = false;
                $scope.results = [];
            }
        })
    });
    this.showResultsFunc = function() {
        return self.showResults;
    }
    $scope.nevigateToArticle = function() {
        window.location = searchService.selectedElement.attr('href');
    };
    $scope.keyPressed = function(event) {

        $scope.specialKeys = false;
        if ($scope.searchInput.length < 2) {
            $scope.results = [];
            self.showResults = false;
            searchService.results = [];
            searchService.selectedElement=[];
            return;
        }

        self.showResults = true;

        self.setSelectedElement = function() {
            searchService.selectedElement = $('.searchResults').find('a').filter(function(index, val) {
                return  $(val).text() == $scope.searchInput;
            });
            $scope.selectedElement = searchService.selectedElement.text();
        }
        if(event.keyCode == 40) {
            $scope.specialKeys = true;
           //select next result
            if(typeof searchService.results[index+1] != "undefined")
            {
                $scope.searchInput = searchService.results[index+1].title;
                self.setSelectedElement();
                console.log(searchService.results[index+1].title);
                index = index + 1;
            }
            return;
        }

        if(event.keyCode == 38) {
            $scope.specialKeys = true;
            //select next result
            if(typeof searchService.results[index-1] != "undefined")
            {
                $scope.searchInput = searchService.results[index-1].title;
                console.log(searchService.results[index-1].title);
                if(index > 0)
                {
                    index = index - 1;
                }
                self.setSelectedElement();
            }
            return;
        }

        if(event.keyCode == 13)
        {
            $scope.nevigateToArticle();
        }

    }
}]);

devArt.directive('searchDirective', ['$http', 'searchService', function($http, searchService) {
    return {
        link : function(scope, element, attr) {
            scope.$watch(attr.searchTerm, function(newVal, oldVal) {
                if(scope.specialKeys)
                {
                    return;
                }
                if (newVal !== "" && newVal !== oldVal) {
                    $http.get('/api/search/' + newVal).success(function (data, status, headers, config) {
                        scope.results = data;
                        searchService.results = data;
                    });
                }
            });
        }
    }
}]);
devArt.controller('SetBookmarksController', ['$scope', '$http', '$cookieStore', function ($scope, $http, $cookieStore) {

    function getCookie(cookieName) {

        if (typeof $cookieStore.get(cookieName) === "undefined") {
            $cookieStore.put(cookieName, []);
        }

        return $cookieStore.get(cookieName);

    }

    function getIndexOfObj(slug, bookmark) {

        for (var i = 0, len = bookmark.length; i < len; i++) {
            if (bookmark[i].slug === slug) {
                return i;
            }
        }
        return -1;
    }

    function setBookmarks(obj, cookieName) {
        var bookmark = getCookie(cookieName);
        var index = getIndexOfObj(obj.slug, bookmark);

        if (index >= 0) {
            bookmark.splice(index, 1);
            index = false;
        }
        else {
            bookmark.push(obj);
            index = true;
        }
        $cookieStore.put(cookieName, bookmark);

        return index;
    }

    this.isBookmarked = function (slug) {
        var bookmark = getCookie('favourites', false);
        var index = getIndexOfObj(slug, bookmark);
        if (index >= 0) {
            return true;
        }
        return false;
    }
    this.setFavourites = function (slug, title) {
        setBookmarks({"slug": slug, "title": title}, 'favourites');
    }

}]);

devArt.controller('BookmarksController', ['$scope', '$http', '$cookieStore', function ($scope, $http, $cookieStore) {

    $scope.listData = [];

    function getBookmarks(cookieName) {
        var listData = $cookieStore.get(cookieName);
        return listData;
    }

    this.showBookmarks = function () {
        $scope.listData = getBookmarks('favourites');
    };

    function removeElement(selected_obj) {
        var index = $scope.listData.map(function(obj, index) {
            if(obj.slug == selected_obj.slug)
            {
                return index;
            }
        }).filter(isFinite)[0];
        $scope.listData.splice(index, 1);
    };

    function removeBookmarks(obj, cookieName) {
        var bookmark = getBookmarks(cookieName);
        removeElement(obj);
        $cookieStore.put(cookieName, $scope.listData);
    }

    this.removeFavourites = function (slug, title) {
        removeBookmarks({"slug": slug, "title": title}, 'favourites');
    }
}]);

devArt.controller('LikeController', ['$http', '$cookieStore', function ($http, $cookieStore) {

    var self = this;

    var className = '';
    this.likeComment = function (comment_id) {
        var comment = {
            'id': comment_id
        };

        var promise = $http({
            method: 'POST',
            url: 'api/comment/like',

            data: $.param(comment)
        });
        promise.success(function (data, status, header, config) {
            self.likes = data;
            self.className = 'liked';
        });
    }
}])
;

devArt.controller('ExpandController', ['$scope', '$cookieStore', function ($scope, $cookieStore) {
    var right_section = $('#admin-right-section');
    var left_section = $('#admin-left-section');
    var expanded = "false";
    if (typeof $cookieStore.get("adminExpanded") !== "undefined") {
        expanded = $cookieStore.get("adminExpanded");
    }
    function expand() {
        right_section.removeClass('col-md-10').addClass('col-md-12');
        left_section.removeClass('col-md-2').addClass('hide');
        $cookieStore.put('adminExpanded', 'true');
    }
    function shrink() {
        right_section.removeClass('col-md-12').addClass('col-md-10');
        left_section.addClass('col-md-2').removeClass('hide');
        $cookieStore.put('adminExpanded', 'false');
    }
    if(expanded == 'false') {shrink();}
    else {expand();}
    $scope.expend = function() {
        if(right_section.hasClass('col-md-10')) {expand();}
        else { shrink();}
    };
}]);

devArt.controller('SubscriptionController', ['$scope', '$http', '$timeout', function($scope, $http, $timeout) {
    $scope.formData = {};
    $scope.subscribeUser = function(event) {
        event.preventDefault();
        $scope.showStatus = true;

        var promise = $http({
            method: 'POST',
            url: '/subscribe',
            data: $.param( $scope.formData )
        });

        promise.success(function (data, status, header, config) {
            if( data == "true") {
                $scope.subscriptionStatus = "All good! Thanks for joining our mailing list, check your email.";
            } else {
                $scope.subscriptionStatus = "Opps! Sorry for inconvenience, some problem occured.";
            }
            $timeout(function() {
                $scope.subscriptionStatus = false;
                $scope.showStatus = false;
            }, 4000);
        });

    }
}]);

devArt.controller('AuthController', ['$scope', function($scope) {
    $scope.promptAuthDialog = function(event) {
        event.preventDefault();
        $('#loginModal').modal('show');
    };

    
}]);

devArt.controller('LoginController', ['$http', function($http) {
    var self = this;
    self.credentials = {};
    self.credentials.email = '';
    self.credentials.password = '';
    self.message = '';
    self.postAsGuest = function() {
        var form = $('#replyForm');
        $('<input />', {
            'type' : 'hidden',
            'name' : 'posttype',
            'value' : 'guest'
        }).appendTo(form);
        form.submit();
    }
    self.loginUser = function(event) {
        event.preventDefault();
        
        var promise = $http({
            method: 'POST',
            url: '/api/login',
            data: $.param( self.credentials )
        });

        promise.success(function (data, status, header, config) {
            if(data == "true")
            {
                $('#replyForm').submit();
            }
            else
            {
                self.message="Please enter the right credentials";
            }
        });
    }

}]);

devArt.filter('limitText', function () {
    return function (text) {
        if (text.length >= 35) {
            return text.substr(0, 35) + '...';
        }
        return text;
    };
});

devArt.directive('toggleSidebar', function () {
    return function (scope, element, attr) {
        var elementId = element.attr('id');

        function toggleElements(newValue, class1, class2) {
            if (newValue) {

                element.addClass(class1)
                    .removeClass(class2);
            }
            else {
                element.addClass(class2)
                    .removeClass(class1);
            }
        }

        scope.$watch(attr.toggleSidebar, function (newValue, oldValue) {
            if (elementId == 'sidebarRight') {
                //element is right side bar ( bookmarks )
                toggleElements(newValue, 'sidebar-right-show', 'sidebar-right-hide');
            } else {
                //element is left side bar ( category )
                toggleElements(newValue, 'sidebar-show', 'sidebar-hide');
            }
        });
    };
});

devArt.directive('bookmarkDirective', function () {
    return function (scope, element, attr) {
        scope.$watch(attr.bookmarkDirective, function (newValue, oldValue) {
            if (newValue) {
                element.addClass('active');
            }
            else {
                element.removeClass('active');
            }
        })
    }
});

devArt.directive('btntextDirective', function () {
    return function (scope, element, attr) {
        scope.$watch(attr.bookmarkDirective, function (newValue, oldValue) {
            if (newValue) {
                element.text('Remove from Bookmark')
            }
            else {
                element.text('Add to Bookmark');
            }
        })
    }
});

devArt.directive('bookmarkToggle', function () {
    return function (scope, element, attr) {
        scope.$watch(attr.bookmarkDirective, function (newValue, oldValue) {
            if (newValue) {
                element.addClass('fa-star').removeClass('fa-star-o');
                element.parent().find('h4').text('Favorited');
            }
            else {
                element.addClass('fa-star-o').removeClass('fa-star');
                element.parent().find('h4').text('Favorite');
            }
        })
    }
});


devArt.directive('bookmarkNotice', function () {
    return function (scope, element, attr) {
        scope.$watch(attr.bookmarkNotice, function (newValue, oldValue) {
            if (newValue) {
                element.removeClass('hide')
            } else {
                element.addClass('hide');
            }
        });
    }
});

devArt.directive('alertMessage', ['$timeout', function ($timeout) {
    return {
        link: function ($scope, element) {
            element.addClass('alert-show');
            $timeout(function () {
                element.removeClass('alert-show');
            }, 10000);
        }

    }
}]);
devArt.directive('navThemeChange', ['$cookieStore', function($cookieStore) {
    return {
        scope : true,
        link : function($scope, $element) {
            var category_btn = $('.category-btn h1');
            var options_bar_options = $('.options-bar-options');
           if ( typeof $cookieStore.get('theme') !== "undefined" )
           {
               $element.addClass($cookieStore.get('theme'));
               category_btn.addClass($cookieStore.get('theme')+'-hover');
               options_bar_options.addClass($cookieStore.get('theme'));
           }
            $element.addClass('show-nav');

            function navbarSlide(newVal)
            {
                if( ! newVal )
                {
                    $(window).off('scroll');
                    return;
                }

                $(window).on('scroll', function () {
                    var scrollTop = $(document).scrollTop();
                        if (scrollTop > 100) {
                            $element.addClass('shrink');
                        } else {
                            $element.removeClass('shrink');
                        }
                });
            }
            $scope.$watch('slideNavbarState', function(newVal) {
                $cookieStore.put('navbarSlide', newVal);
                navbarSlide(newVal);
            })
        },
        controller : ['$scope', '$element', function($scope, $element) {
            $scope.slideNavbarState = false;
            var category_btn = $('.category-btn h1');
            var options_bar_options = $('.options-bar-options');
            $scope.changeTheme = function(color) {
                if(color == 'yellow')
                {
                    $element.addClass('yellowBar').removeClass('darkGrayBar darkBlueBar blueBar');
                    category_btn.addClass('yellowBar-hover').removeClass('darkGrayBar-hover darkBlueBar-hover blueBar-hover');
                    options_bar_options.addClass('yellowBar').removeClass('darkGrayBar darkBlueBar blueBar');
                    $cookieStore.put('theme', 'yellowBar');
                }
                else if(color == 'darkGray') {
                    $element.addClass('darkGrayBar').removeClass('yellowBar darkBlueBar blueBar');
                    category_btn.addClass('darkGrayBar-hover').removeClass('yellowBar-hover darkBlueBar-hover blueBar-hover');
                    options_bar_options.addClass('darkGrayBar').removeClass('yellowBar darkBlueBar blueBar');
                    $cookieStore.put('theme', 'darkGrayBar');
                }
                else if(color == 'blue')
                {
                    $element.addClass('blueBar').removeClass('yellowBar darkBlueBar darkGaryBar');
                    category_btn.addClass('blueBar-hover').removeClass('yellowBar-hover darkBlueBar-hover darkGaryBar-hover');
                    options_bar_options.addClass('blueBar').removeClass('yellowBar darkBlueBar darkGaryBar');
                    $cookieStore.put('theme', 'blueBar');
                }
                else {
                    $element.addClass('darkBlueBar').removeClass('yellowBar darkGrayBar blueBar');
                    category_btn.addClass('darkBlueBar-hover').removeClass('yellowBar-hover darkGrayBar-hover blueBar-hover');
                    options_bar_options.addClass('darkBlueBar').removeClass('yellowBar darkGrayBar blueBar');
                    $cookieStore.put('theme', 'darkBlueBar');
                }
            }

            $scope.toggleDisplayState = function() {
                $scope.slideNavbarState = !$scope.slideNavbarState;
            }
        }]

    };
}]);

devArt.directive('navbarDisplayState', ['$cookieStore', function($cookieStore) {
    return {
        link : function($scope, $element, $attr) {

            if ( typeof $cookieStore.get('navbarSlide') !== "undefined" )
            {
                var canSlide = $cookieStore.get('navbarSlide');

                if( canSlide )
                {
                    $scope.toggleDisplayState();
                    $element.toggleClass('active');
                }
            }

            $element.on('click', function() {
                $scope.toggleDisplayState();
                $element.toggleClass('active');
            });
        }
    }
}]);

devArt.directive('socialButton', [ function() {
    return {
        scope : true,
        transclude : true,
        template : '<a class="btn btn-[[ className ]]" href="[[url]]" ><i class="[[ socialIcon ]]"></i> <span class="hidden-xs">[[ text ]]</span>  </a>',
        link : function(scope, element, attrs) {
            scope.url = attrs.siteUrl;
            scope.socialIcon = attrs.icon;
            scope.className = attrs.socialSite;
            scope.text = attrs.linkText;
        }
    }
}]);
devArt.directive('dirDisqus', ['$window', function ($window) {
    return {
        restrict: 'E',
        scope: {
            disqus_shortname: '@disqusShortname',
            disqus_identifier: '@disqusIdentifier',
            disqus_title: '@disqusTitle',
            disqus_url: '@disqusUrl',
            disqus_category_id: '@disqusCategoryId',
            disqus_disable_mobile: '@disqusDisableMobile',
            disqus_config_language: '@disqusConfigLanguage',
            readyToBind: "@"
        },
        template: '<div id="disqus_thread"></div><a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>',
        link: function (scope) {

            // ensure that the disqus_identifier and disqus_url are both set, otherwise we will run in to identifier conflicts when using URLs with "#" in them
            // see http://help.disqus.com/customer/portal/articles/662547-why-are-the-same-comments-showing-up-on-multiple-pages-
            if (typeof scope.disqus_identifier === 'undefined' || typeof scope.disqus_url === 'undefined') {
                throw "Please ensure that the `disqus-identifier` and `disqus-url` attributes are both set.";
            }

            scope.$watch("readyToBind", function (isReady) {

                // If the directive has been called without the 'ready-to-bind' attribute, we
                // set the default to "true" so that Disqus will be loaded straight away.
                if (!angular.isDefined(isReady)) {
                    isReady = "true";
                }
                if (scope.$eval(isReady)) {
                    // put the config variables into separate global vars so that the Disqus script can see them
                    $window.disqus_shortname = scope.disqus_shortname;
                    $window.disqus_identifier = scope.disqus_identifier;
                    $window.disqus_title = scope.disqus_title;
                    $window.disqus_url = scope.disqus_url;
                    $window.disqus_category_id = scope.disqus_category_id;
                    $window.disqus_disable_mobile = scope.disqus_disable_mobile;
                    $window.disqus_config = function () {
                        this.language = scope.disqus_config_language;
                    };
                    // get the remote Disqus script and insert it into the DOM, but only if it not already loaded (as that will cause warnings)
                    if (!$window.DISQUS) {
                        var dsq = document.createElement('script');
                        dsq.type = 'text/javascript';
                        dsq.async = true;
                        dsq.src = '//' + scope.disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    } else {
                        $window.DISQUS.reset({
                            reload: true,
                            config: function () {
                                this.page.identifier = scope.disqus_identifier;
                                this.page.url = scope.disqus_url;
                                this.page.title = scope.disqus_title;
                                this.language = scope.disqus_config_language;
                            }
                        });
                    }
                }
            });
        }
    };
}]);

//////////////////////////////////////////////////////////////Jquery Code/////////////////////////////////////////////////////////////////

$(function () {
    var $nav = $('nav.navbar'),
        $sidebar = $('.sidebar'),
        $categoryBtn = $('.category-btn'),
        $pin = $('#pin span');

    $('[data-toggle="tooltip"]').tooltip();

    //$nav.on('mouseover',function () {
    //});
    $nav.hover(function() {
        $nav.removeClass('shrink');
    }, function() {
        var scrollTop = $(document).scrollTop();
        if($pin.hasClass('active'))
        {
            return;
        }
        if(scrollTop > 100)
        {
            $nav.addClass('shrink');
        }
    })

    $('.custom-file-input').on('change', function (event) {

        var $this = $(this),
            fileList = $this[0].files,
            filesLen = fileList.length;

        var $el = $('#filesInfo');
        for (var x = 0; x < filesLen; x++) {
            var $lis = $('<li></li>', {
                'class': 'list-group-item',
                'text': fileList[x].name + " -- " + Math.floor(fileList[x].size / 1024) + ' KB'
            });

            $lis.appendTo($el);
        }
    });

    $('.downloaded-image').on('click', function (e) {

        e.preventDefault();
        var $this = $(this),
            $details_img = $('#image_details #image_details_img'),
            $image_name_input = $('#image_details #image_name'),
            $thumb_name_input = $('#image_details #thumb_name'),
            $image_name_hidden_input = $('#image_details #image_name_original'),
            $thumb_name_hidden_input = $('#image_details #thumb_name_original'),
            $modal = $('#imagemodal'),
            $modalImage = $('#modalImage');

            $modalImage.attr('src', $this.find('img').data('name'));
            $modalImage.attr('alt', $this.find('img').attr('alt'));
            //$modal.modal('show');


            $details_img.attr('src', $this.find('img').data('name'));
            $details_img.attr('alt', $this.find('img').data('alt'));
            $image_name_input.val($this.find('img').data('name'));
            $image_name_hidden_input.val($this.find('img').data('name'));
            $thumb_name_input.val($this.find('img').attr('src'));
            $thumb_name_hidden_input.val($this.find('img').attr('src'));

    });

    $('#image_details #image_details_img').on('click', function() {

        var $this = $(this),
            $modal = $('#imagemodal'),
            $modalImage = $('#modalImage');

            $modalImage.attr('src', $this.data('name'));
            $modalImage.attr('alt', $this.attr('alt'));
            $modal.modal('show');
    });

    $('#modalImageList').on('click', 'img', function () {
        $('#imageurlpath').val($(this).attr('src'));
    })

    $('#imageSelectBtn').on('click', function (e) {
        $image_val = $('#imageurlpath').val();
        if ($image_val == "") {
            alert('Please Select an Image');
            e.stopPropagation();
        }
        else {
            $('#image').val($image_val);
        }
    });

    $('span.edit-comment').on('click', function () {
        var $id = $(this).attr('data-replyId'),
            $modal = $('#editCommentModal'),
            $textareaDiv = $modal.find('.cke_editable');
        $commentId = $('#comment_id');

        $.get('api/comment/' + $id + '/edit')
            .done(function (data) {
                $textareaDiv.html(data.body);
                $commentId.val($id);
                $modal.modal();
            })
    });

    $('a.replyQuote').on('click', function (e) {
        var $commentDiv = $(this).closest('.reply'),
            $textareaDiv = $('.reply-box').find('.cke_editable'),
            $username = $commentDiv.find('.user-name').text(),
            $answer = $commentDiv.find('.reply-body').html();

        var $html = $('<blockquote></blockquote>', {
            'class': 'quoted-reply',
            'html': '<span class="quoted-user">' + $username + ' said, </span>' + $answer
        });
        $("body").animate({scrollTop: $(document).height()}, 1000);
        $textareaDiv.prepend($html).focus();
        e.preventDefault();
    })

    var topSerachBox = $('#searchInputBox');
    $('#topSearchBtn').on('click', function() {
        // topSerachBox.addClass('search-expanded');
    });

    $(document).on('click', function (e)
    {
        var container = $('.searchInputContainer');

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            // topSerachBox.removeClass('search-expanded');
        }
    });
    var category_heading = $('#category_heading');
    var sidebar = $('#sidebar');
    var fixed_category_shown = false;

    $(window).on('scroll', function () {
        var scrollTop = $(document).scrollTop();
        if (scrollTop > 100) {
            if(fixed_category_shown == true)
            {
                return;
            }
            category_heading.addClass('fixed_category');
            setTimeout(function() {
                category_heading.addClass('show_fixed_category');
            }, 500);
            sidebar.addClass('fixed_sidbar_navigation');
            fixed_category_shown = true;
        } else {
            if(fixed_category_shown == false)
            {
                return;
            }
            category_heading.removeClass('fixed_category show_fixed_category');
            sidebar.removeClass('fixed_sidebar_navigation');
            fixed_category_shown = false;
        }
    });
    var right_category_articles_container = $('.category_content'),
        right_category_articles_ul = right_category_articles_container.find('ul'),
        related_articles = $('.related_articles'),
        right_category_articles_top,
        height_to_stick,
        show_right_ul,
        position_fixed,
        scrollTop = $(document).scrollTop();

    if(related_articles[0] != undefined)
    {
        $(window).on('scroll', function () {

            scrollTop = $(document).scrollTop();
            height_to_stick = related_articles.offset().top - (right_category_articles_ul.height() + 85);
            right_category_articles_top = right_category_articles_container.offset().top;

            if (scrollTop > height_to_stick){
                if( position_fixed != true) {
                    right_category_articles_ul.addClass('fix_ul');
                    right_category_articles_ul.css('top', (height_to_stick -right_category_articles_top + 85)+'px');
                    position_fixed = true;
                }
            }
            else {
                if(position_fixed != false) {
                    right_category_articles_ul.removeClass('fix_ul');
                    right_category_articles_ul.css('top', '75px');
                    position_fixed = false;
                }
            }

            if( scrollTop > right_category_articles_top ) {
                if(show_right_ul != true) {
                    right_category_articles_ul.addClass('show_right_ul');
                    show_right_ul = true;
                }
            } else {
                if(show_right_ul != false) {
                    right_category_articles_ul.removeClass('show_right_ul');
                    show_right_ul = false;
                }
            }
        });
    }


    //Adding Toggle Button with Each hidable image
    var hidable_image = $('.hidable_image');
    var btn = $('<button></button>', {
        'class' : 'btn btn-default image_demo_toggle',
        'text' : 'Toggle Image',
    }).insertBefore(hidable_image);

    btn.on('click', function() {
       $('.hidable_image').toggle();
    });

    //Warpping Each Image element in article with Ancher Tag
    $.each($('#articleBody > p > img , #articleBody > img'), function( index, val) {
        var ancher = $('<a></a>', {
            'href' : $(val).attr('src'),
            'data-lighter': ''
        });
        $(val).wrap(ancher);
    });

    //attaching traget blank on each ancher tag
    $.each($('#articleBody a'), function( index, val) {
       $(val).attr('target', '_blank');
    });


    //changing border color of subscription form on input focus
    var subscription_form = $('.footer-form');
    subscription_form.find('input').on('focus', function() {
        subscription_form.addClass('blue-focus');
    });
    subscription_form.find('input').blur(function() {
        subscription_form.removeClass('blue-focus');
    });

    $('#showPostTextArea').on('click', function() {
        $('html, body').animate({
            scrollTop: $(".cke_contents").offset().top-200
        }, 500);
    })


    //Script for showing subsciption modal
    //setTimeout(function() {
    //    $('#subscription_modal').modal('show');
    //}, 10000);

    //$(document).on('mousemove', function(e) {
    //    console.log('hello') ;
    //});
    //setTimeout(function() {
    //    $(window).on('mousemove', function(e) {
    //        if (e.clientY < 10) {
    //            $('#subscription_modal').modal('show');
    //            $(window).off('mousemove');
    //        }
    //    });
    //}, 1000 * 60);

});
