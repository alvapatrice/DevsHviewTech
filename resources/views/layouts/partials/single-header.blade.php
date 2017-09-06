<meta name="author" content="{{ $article->user->name }}">
<meta name="description" content="{{ $article->description }}">
<link rel="canonical" href="{{ route('articles.single', [$article->slug]) }}">

<!-- Open Graph for facebook -->
<meta property="og:title" content="{{ $article->title }}"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="{{ route('articles.single', [$article->slug]) }}"/>
<meta property="og:image" content="{{ asset($article->image) }}"/>
<meta property="og:site_name" content="Devs@Hviewtech"/>
<meta property="fb:app_id" content="{{ getenv('FACEBOOK_CLIENT_ID') }}" />
<meta property="og:description"
      content="{{ $article->description }}"/>
<meta property="article:publisher" content="https://www.facebook.com/nostalgie.alvapatrice">
<meta name="author" content="{{ $article->user->name }}">
<meta property="og:locale" content="en_US" />

<!-- Twitter Card Style -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@p_nostalgie">
<meta name="twitter:creator" content="@p_nostalgie">
<meta name="twitter:title" content="{{ $article->title}}">
<meta name="twitter:description" content="{{ $article->description }}">
<meta name="twitter:image:src" content="{{ asset($article->image) }}">
<meta property="twitter:account_id" content="3034383360">