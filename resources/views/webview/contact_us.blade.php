@extends('webview.layout')
@section('title', $page->title ?? 'Contact Us')
@section('page_title', 'Contact Us')
@section('body')
<section class="hero">
  <h1>{{ $page->title ?? 'Contact Us' }}</h1>
  <p>{{ $page->hero_text ?? 'Find our headquarters and branch locations across Malaysia.' }}</p>
</section>

@php $hq = $branches->where('type','hq')->first(); @endphp
@if($hq)
<section class="card">
  <div class="section-head"><div><span class="section-tag">Headquarters</span><h2>{{ $hq->name }}</h2></div></div>
  @if($hq->address)<p class="body-copy">{{ $hq->address }}</p>@endif
  <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:14px;">
    @if($hq->phone)<a class="btn btn-primary" href="tel:{{ $hq->phone }}">📞 Call HQ</a>@endif
    @if($hq->whatsapp_url)<a class="btn btn-secondary" href="{{ $hq->whatsapp_url }}" target="_blank">💬 WhatsApp</a>@endif
    @if($hq->map_url)<a class="btn btn-secondary" href="{{ $hq->map_url }}" target="_blank">🗺️ Open Map</a>@endif
  </div>
</section>
@endif

@php $branchList = $branches->where('type','branch'); @endphp
@if($branchList->count())
<section class="card">
  <div class="section-head"><div><span class="section-tag">Branches</span><h2>Our Locations</h2></div></div>
  @foreach($branchList as $branch)
  <div style="border:1px solid var(--line);border-radius:14px;padding:14px;margin-bottom:12px;">
    <strong style="font-size:15px;">{{ $branch->name }}</strong>
    @if($branch->city || $branch->state)
    <p class="body-copy" style="margin:4px 0;">{{ implode(', ', array_filter([$branch->city, $branch->state])) }}</p>
    @endif
    @if($branch->address)<p class="body-copy" style="margin:4px 0;font-size:13px;">{{ $branch->address }}</p>@endif
    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:10px;">
      @if($branch->phone)<a class="btn btn-primary" style="min-height:36px;font-size:13px;" href="tel:{{ $branch->phone }}">📞 Call</a>@endif
      @if($branch->whatsapp_url)<a class="btn btn-secondary" style="min-height:36px;font-size:13px;" href="{{ $branch->whatsapp_url }}" target="_blank">💬 WhatsApp</a>@endif
      @if($branch->map_url)<a class="btn btn-secondary" style="min-height:36px;font-size:13px;" href="{{ $branch->map_url }}" target="_blank">🗺️ Map</a>@endif
    </div>
  </div>
  @endforeach
</section>
@endif
@endsection
