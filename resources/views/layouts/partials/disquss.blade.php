<div class="row padd-tb-15">
    <div class="container">
        <div class="row">
           <div class="col-md-12">
               <div class="panel panel-default comment-container">
                   <div class="panel-heading">
                        <h4>Something to say? Tell us in comment section.</h4>
                   </div>
                   <div class="panel-body">
                       <dir-disqus disqus-shortname="Devs@HviewTech"
                                   disqus-identifier="[['{{ $article->id . "_" . $article->slug }}']]"
                                   disqus-title="[['{{ $article->title }}']]"
                                   disqus-url="[['{{ route("articles.single", [ $article->slug])}}']]"
                                   >
                       </dir-disqus>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>