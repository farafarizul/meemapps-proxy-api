@extends('webview.layout')
@section('title', $page->title ?? 'Shariah Advisor')
@section('page_title', 'Shariah Advisor')
@section('body')
<section class="hero">
  <h1>{{ $page->title ?? 'Shariah Advisory' }}</h1>
  <p>{{ $page->hero_text ?? 'Our Shariah compliance is guided by independent Islamic scholars.' }}</p>
</section>
<section class="card">
  <div class="section-head"><div><span class="section-tag">Shariah Advisory</span><h2>Our Shariah Compliance Framework</h2></div></div>
  <img src="{{ asset('webview-assets/sharia-advisor.jpg') }}" style="width:100%;border-radius:14px;margin-bottom:14px;" alt="Shariah Advisor">
  <p class="body-copy">MEEM Gold operates under a Shariah-compliant framework as certified by Elzar Shariah Solutions &amp; Advisory.</p>
  <p class="body-copy">Our Shariah advisor, <strong>Dr. Zaharuddin Abdul Rahman</strong>, ensures that all products and transactions comply with Islamic finance principles.</p>
  <img src="{{ asset('webview-assets/shariah-certificate-renewal-25042024.jpg') }}" style="width:100%;border-radius:14px;margin-top:14px;" alt="Shariah Certificate">
</section>
@endsection
