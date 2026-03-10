@extends('webview.layout')
@section('title', $page->title ?? 'Account Closure')
@section('page_title', 'Account Closure')
@section('body')
<section class="hero">
  <h1>{{ $page->title ?? 'Account Closure Request' }}</h1>
  <p>{{ $page->hero_text ?? 'We\'re sorry to see you go. Please read through the closure process below.' }}</p>
</section>
<section class="card">
  <div class="section-head"><div><span class="section-tag">Closure Process</span><h2>How to close your account</h2></div></div>
  @if($page && $page->content_json)
    @foreach($page->content_json as $item)
    <p class="body-copy">{{ $item }}</p>
    @endforeach
  @else
  <p class="body-copy">To close your MEEM Gold account, please contact our support team or visit any of our branch locations with a valid identification document.</p>
  <p class="body-copy">All outstanding balances must be settled before the account can be closed. Gold balances can be redeemed or sold prior to closure.</p>
  <p class="body-copy">For assistance, please WhatsApp or call our HQ at <strong>03-5523 1231</strong>.</p>
  @endif
</section>
@endsection
