<!-------------------------------------------- Hero Area Markup ------------------------------------------------------------->
<div class="hero-container row">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-2">
                <h2 class="category-heading"><a href="{{ route('categories.single', [ 'php' ]) }}"><span >PHP</span></a></h2>
            </div>
            <div class="col-md-3 col-xs-2">
                <h2 class="category-heading"><a href="{{ route('categories.single', [ 'java' ]) }}"><span >Java</span></a></h2>
            </div>
            <div class="col-md-3 col-xs-2">
                <h2 class="category-heading"><a href="{{ route('categories.single', ['nodeJS']) }}"><span>NodeJs</span></a></h2>
            </div>
            <div class="col-md-3 col-xs-2">
                <h2 class="category-heading"><a href="{{ route('categories.list') }}"><span>Explore All</span></a></h2>
            </div>
        </div>
    </div>
</div>
<!-------------------------------------------- Hero Area Markup Ends ------------------------------------------------------------->
