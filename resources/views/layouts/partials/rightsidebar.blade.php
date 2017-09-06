<div id="sidebarRight" toggle-sidebar="app.isBookmarkShow" class="sidebar-right sidebar-right-hide card-shadow">
    <ul class="list-unstyled bookmarks-options" ng-click="app.stopProp($event)">

        <li ng-repeat="bookmark in listData">
            <a href="/articles/[[bookmark.slug]]">[[bookmark.title | limitText]]
                <span class="fa fa-times pull-right" ng-click="bookmarks.removeFavourites(bookmark.slug, bookmark.title); $event.preventDefault()"></span>
            </a>
        </li>

        <li bookmark-notice="!listData.length" class="sidebar-notice">There are no Bookmarks</li>
        <li bookmark-notice="listData.length" class="sidebar-notice">Clearing Cookies will remove Bookmarks</li>
        {{--@foreach($categories as $category)--}}
        {{--<li><a href="#">{{$category['title']}}</a></li>--}}
        {{--@endforeach--}}
    </ul>
</div>