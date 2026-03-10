@extends('webview.layout')
@section('title', $page->title ?? 'Coming Soon')
@section('page_title', 'Coming Soon')
@section('body')
<section class="hero" style="text-align:center;padding:40px 20px;">
  <h1 style="font-size:36px;">🚧</h1>
  <h1>{{ $page->title ?? 'Coming Soon' }}</h1>
  <p>{{ $page->hero_text ?? 'Something great is on the way. Stay tuned for updates!' }}</p>
</section>
<section class="card" style="text-align:center;">
  <p class="body-copy">{{ $page->subtitle ?? 'This feature is currently under development. We\'re working hard to bring it to you.' }}</p>
</section>
@endsection
