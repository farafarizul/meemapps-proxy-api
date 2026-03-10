@extends('webview.layout')
@section('title', $page->title ?? 'About Us')
@section('page_title', 'About Us')
@section('body')
<section class="hero">
  <h1>{{ $page->title ?? 'Welcome to MEEM Gold' }}</h1>
  <p>{{ $page->hero_text ?? 'A wide range of physical gold products made available for customers.' }}</p>
</section>

<section class="card">
  <div class="section-head"><div><span class="section-tag">Our Story</span><h2>Trusted, ethical and Shariah-compliant gold solutions</h2></div></div>
  <p class="body-copy">{{ $page->subtitle ?? 'MEEM Gold stands out in the gold trading industry for its steadfast adherence to Islamic finance principles.' }}</p>
  <p class="body-copy">We specialise in custom gold bars &amp; jewellery, offering great value, amazing product variety and professional friendly service.</p>
  <p class="body-copy">Through rigorous compliance with Shariah law, the company ensures its gold products are ethically sourced, meticulously verified for purity, and free from prohibited financial practices.</p>
</section>

<section class="card">
  <img src="{{ asset('webview-assets/gold-bar-100g.jpg') }}" style="width:100%;border-radius:14px;margin-bottom:12px;" alt="MEEM Gold">
  <h3 style="margin:0 0 8px;">Beautifully crafted gold collections</h3>
  <p class="body-copy">Everyone deserves to shine. MEEM Gold &amp; Jewellery's extensive collection in Malaysia is meaningfully conceptualised and beautifully crafted.</p>
</section>
@endsection
