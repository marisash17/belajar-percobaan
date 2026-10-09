@php
    use Carbon\Carbon;
    $date = Carbon::parse($w['date'], 'Asia/Jakarta')->locale('id');
    $b = $w['bride']; $g = $w['groom'];
    $names = $b['nick'].' & '.$g['nick'];
    $long  = $date->isoFormat('dddd, D MMMM Y');
    $offset = $date->copy()->startOfMonth()->dayOfWeek;
    $venue = end($w['events']);
    $mapq  = urlencode($venue['place'].' '.$venue['address']);
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Undangan Pernikahan {{ $names }}</title>
<meta name="theme-color" content="#4A1218">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gaegu:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root{--wine:#4A1218;--wine2:#6B1F27;--olive:#8A9A5B;--ink:#4A1218;--pearl:#F1ECE2;--hand:'Gaegu','Comic Sans MS',cursive;--sans:'Poppins',system-ui,sans-serif}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:var(--sans);font-weight:300;font-size:clamp(14px,.35vw + 12.6px,17px);line-height:1.6;color:var(--ink);background:#fff;-webkit-font-smoothing:antialiased;overflow-x:hidden}
:focus-visible{outline:2px solid var(--olive);outline-offset:3px}
.col{max-width:480px;margin:0 auto;padding:0 28px;position:relative}
section{padding:56px 0;text-align:center;position:relative}
h1,h2,h3{font-family:var(--hand);font-weight:700;line-height:1.05}
.olive{color:var(--olive)}
.cord{background:var(--wine) repeating-linear-gradient(90deg,rgba(0,0,0,.22) 0 2px,transparent 2px 5px);color:#fff}
.deco{position:absolute;pointer-events:none}
.pearls{position:absolute;pointer-events:none;overflow:visible}
.pearls path{fill:none;stroke:var(--pearl);stroke-width:9;stroke-linecap:round;stroke-dasharray:0 11;filter:drop-shadow(0 1px 1px rgba(0,0,0,.35))}

/* Hero */
.hero{min-height:100vh;min-height:100svh;display:flex;align-items:center;justify-content:center;text-align:center;position:relative;overflow:hidden;padding:90px 20px 110px}
.hero h1{font-size:clamp(2.3rem,11.5vw,3.6rem);color:var(--olive);min-height:3.3em;max-width:340px;margin:0 auto 6px}
.hero h1 i{display:inline-block;width:2px;height:.8em;background:var(--olive);margin-left:3px;vertical-align:-.05em;animation:blink 1s steps(1) infinite}
@keyframes blink{50%{opacity:0}}
.faces{display:flex;justify-content:center;gap:4px;margin:0 auto}
.faces svg,.faces .face{width:110px;height:132px}
.faces .face{display:block;border-radius:50%;border:6px solid var(--wine);overflow:hidden;background:#ece8e4}
.faces .face img{width:100%;height:100%;object-fit:cover;object-position:center 22%;display:block}
.hero .nm{font:700 2rem var(--hand);margin-top:6px}
.hero .dt{font:700 1.5rem var(--hand);letter-spacing:.08em}
.star{position:absolute;right:20px;bottom:36px;width:70px;text-align:center;background:none;border:0;color:var(--wine);font:400 .8rem/1.2 var(--sans);cursor:pointer}
.star svg{width:46px;height:46px;display:block;margin:0 auto 2px;fill:var(--wine);transform:rotate(-12deg)}
.star.on svg{animation:spin 5s linear infinite}
@keyframes spin{to{transform:rotate(348deg)}}

/* Pasangan */
.celeb h2{font-size:2.1rem;color:var(--olive);margin-bottom:18px}
.duo{position:relative;width:min(320px,100%);aspect-ratio:320/190;margin:0 auto 18px}
.duo .c{position:absolute;top:0;width:45%;height:100%;border-radius:22px;overflow:hidden;display:flex;align-items:flex-end;justify-content:center}
.duo .c:first-child{left:0}.duo .c:nth-child(2){right:0}
.duo .c svg{width:78%;height:88%}
.duo img{width:100%;height:100%;object-fit:cover;object-position:center top}
.duo .eye{position:absolute;width:17px;height:17px;border-radius:50%;background:#e9e4dc;border:4px solid #bdb7ad;box-shadow:inset 0 0 0 3px var(--wine)}
.person h3{font-size:2.3rem;color:var(--wine)}
.person p{font-size:.78rem;max-width:230px;margin:0 auto}
.person .and{font:700 2rem var(--hand);margin:10px 0}

/* Hitung mundur */
.count{padding:54px 0 46px;position:relative}
.count h2{font-size:1.5rem;letter-spacing:.2em;margin-bottom:8px}
.cd{display:flex;justify-content:center;align-items:flex-start;gap:clamp(2px,1.5vw,10px);font:300 clamp(1.9rem,10.5vw,3rem)/1 var(--sans)}
.cd div{min-width:1.6em}
.cd div span{display:block;font-size:.58rem;letter-spacing:.18em;margin-top:8px}
.cd em{font-style:normal}

/* Kalender */
.cal{padding:70px 0 40px}
.calbox{position:relative;max-width:340px;margin:0 auto;border-radius:26px;padding:26px 26px 22px;text-align:left}
.calbox h3{font-size:1.5rem;margin-bottom:10px}
.grid{display:grid;grid-template-columns:repeat(7,1fr);gap:7px 0;text-align:center;font-size:.8rem}
.grid b{font-weight:400}
.grid .hl{background:#fff;color:var(--wine);font-weight:500;clip-path:polygon(50% 0,62% 33%,98% 36%,70% 58%,80% 95%,50% 74%,20% 95%,30% 58%,2% 36%,38% 33%);display:flex;align-items:center;justify-content:center;width:32px;height:32px;margin:-6px auto;font-size:.7rem}
.ball{position:absolute;border-radius:50%;background:radial-gradient(circle at 32% 30%,#fff,#d7d7d7 35%,#8a8a8a 80%);box-shadow:0 6px 10px rgba(0,0,0,.3)}
.ball::after{content:"";position:absolute;inset:0;border-radius:50%;background:repeating-linear-gradient(0deg,rgba(60,60,60,.35) 0 1px,transparent 1px 8px),repeating-linear-gradient(90deg,rgba(60,60,60,.35) 0 1px,transparent 1px 8px)}
.ball i{position:absolute;left:50%;bottom:100%;width:2px;background:#aaa}

/* Detail acara */
.ev h3{font-size:1.9rem;color:var(--wine);margin-top:22px}
.ev p{font-size:.95rem}
.ev small{color:#7a5a5e;font-size:.8rem}
.map{width:100%;max-width:300px;height:190px;border:0;border-radius:6px;margin:22px auto 0;display:block}
.btn{display:inline-block;margin-top:14px;font:400 .85rem var(--sans);padding:10px 24px;border-radius:999px;border:1.5px solid var(--wine);background:var(--wine);color:#fff;text-decoration:none;cursor:pointer}
.btn:hover{background:transparent;color:var(--wine)}
.btn.o{background:transparent;color:var(--wine)}.btn.o:hover{background:var(--wine);color:#fff}

/* Hadiah */
.gift{min-height:600px}
.gift h2{font-size:2.7rem;color:var(--olive);margin:0 0 14px auto;width:min(190px,45%);text-align:left;margin-right:16px}
.stamps{display:flex;flex-wrap:wrap;justify-content:center;gap:0 22px}
.gift>.col>p{font-size:.78rem;max-width:300px;margin:0 auto 24px}
.stamp{width:min(250px,86%);margin:0 auto 22px;padding:22px 20px;background:#fff;border:1.5px solid #a7ae8c;outline:1.5px solid #a7ae8c;outline-offset:-7px;text-align:left;transform:rotate(-3deg);box-shadow:0 2px 6px rgba(0,0,0,.08)}
.stamp:nth-of-type(even){transform:rotate(2deg)}
.stamp b{display:block;font:700 1.35rem var(--hand);color:#b4272f}
.stamp .no{font-size:1.05rem;letter-spacing:.06em;margin-top:6px}
.stamp span{font-size:.78rem;display:block}
.stamp button{margin-top:8px;font:400 .72rem var(--sans);border:1px solid var(--wine);background:none;color:var(--wine);border-radius:99px;padding:3px 14px;cursor:pointer}

/* Penutup */
.quote p{font-size:.8rem;max-width:300px;margin:12px auto 22px}
.quote h2{font-size:1.9rem;color:var(--olive)}

/* Ucapan */
.wish h2{font-size:2.1rem;color:var(--olive);margin-bottom:14px}
form{display:grid;gap:12px;text-align:left}
label{font-size:.78rem;display:block;margin-bottom:2px}
input,select,textarea{width:100%;font:300 .9rem var(--sans);color:var(--ink);border:1px solid #cdbfc0;border-radius:10px;padding:10px 12px;background:#fff}
textarea{min-height:90px;resize:vertical}
.err{color:#b4272f;font-size:.75rem}
.ok{background:var(--wine);color:#fff;padding:10px;border-radius:10px;margin-bottom:12px;font-size:.85rem}
.list{margin-top:24px;max-height:380px;overflow-y:auto;display:grid;gap:10px;text-align:left}
.wi{padding:12px 14px;border-left:3px solid var(--olive);background:#faf7f5;border-radius:0 10px 10px 0}
.wi b{font:700 1.15rem var(--hand);color:var(--wine)}
.wi em{font-style:normal;font-size:.7rem;color:#8a7074;margin-left:6px}
.wi p{font-size:.85rem;word-break:break-word}

footer{position:relative;overflow:hidden;padding:60px 0 56px;text-align:left}
footer small{font-size:.85rem}
footer h2{font-size:2.6rem}

/* ===== Responsif ===== */
img,svg,iframe{max-width:100%}
.evs>div+div{margin-top:0}
.ev h3:first-child{margin-top:22px}
@media (max-width:360px){
  .col{padding:0 20px}
  .faces svg,.faces .face{width:88px;height:106px}
  .star{right:12px;width:60px;font-size:.7rem}
  .grid{font-size:.72rem;gap:5px 0}
  .calbox{padding:22px 16px 18px}
  .person .and{font-size:1.7rem}
}
@media (min-width:768px){
  .col{max-width:680px;padding:0 40px}
  section{padding:84px 0}
  .hero h1{font-size:clamp(3.6rem,7vw,5.4rem);max-width:560px;min-height:3.2em}
  .faces svg,.faces .face{width:150px;height:180px}
  .hero .nm{font-size:2.6rem}.hero .dt{font-size:2rem}
  .hero .deco,.gift .deco{scale:1.6}
  .star{right:44px;bottom:48px;width:90px;font-size:.95rem}.star svg{width:60px;height:60px}
  .celeb h2{font-size:3rem}
  .duo{width:min(460px,100%)}
  .person h3{font-size:3rem}.person p{font-size:.92rem;max-width:320px}
  .count h2{font-size:2rem}
  .cd{font-size:clamp(3.4rem,7vw,5rem)}.cd div span{font-size:.75rem}
  .calbox{max-width:420px;padding:32px 32px 28px}.calbox h3{font-size:2rem}.grid{font-size:.95rem;gap:10px 0}
  .evs{display:grid;grid-template-columns:1fr 1fr;gap:0 24px}
  .ev h3{font-size:2.3rem}.ev p{font-size:1.05rem}
  .map{max-width:560px;height:280px}
  .gift h2{font-size:3.4rem;text-align:center;width:auto;margin:0 0 16px}
  .gift>.col>p{max-width:460px;font-size:.92rem}
  .stamp{width:270px}
  .quote p{max-width:460px;font-size:.95rem}.quote h2{font-size:2.6rem}
  .wish form{grid-template-columns:1fr 1fr}
  .wish form>div:nth-child(1),.wish form>div:nth-child(4),.wish form>button{grid-column:1/-1}
  footer h2{font-size:3.4rem}
}
@media (min-width:1100px){
  .col{max-width:760px}
  .hero .deco,.gift .deco{scale:2}
  .hero h1{font-size:6rem;max-width:680px}
  .calbox{max-width:480px}
}
@media (max-height:520px) and (orientation:landscape){.hero{padding:60px 20px 70px}.faces svg,.faces .face{width:80px;height:96px}}
@media (prefers-reduced-motion:reduce){.hero h1 i,.star.on svg{animation:none}html{scroll-behavior:auto}}
</style>
</head>
<body>

{{-- Ilustrasi (SVG) dipakai ulang lewat <use> --}}
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <symbol id="star" viewBox="0 0 100 100"><path d="M50 3l14 30 33 4-24 23 6 33-29-16-29 16 6-33L3 37l33-4z" stroke="currentColor" stroke-width="5" stroke-linejoin="round"/></symbol>
    <symbol id="anth" viewBox="0 0 160 190">
      <path d="M80 8C132 8 162 62 132 112 112 146 92 164 84 186 76 164 50 146 30 112-2 60 28 8 80 8Z" fill="#4A1218"/>
      <path d="M52 40C60 22 80 16 96 20 78 28 60 44 56 70 48 62 46 50 52 40Z" fill="#7A2A32" opacity=".7"/>
      <path d="M84 186c0-30 6-52 8-86" stroke="#6C7A3A" stroke-width="7" fill="none" stroke-linecap="round"/>
      <path d="M84 112C70 100 78 60 96 40c6 30 4 56-12 72Z" fill="#D9D56A"/>
    </symbol>
    <symbol id="calla" viewBox="0 0 120 220">
      <path d="M60 215C58 160 62 120 66 84" stroke="#5E6D31" stroke-width="6" fill="none" stroke-linecap="round"/>
      <path d="M28 10C6 44 12 92 46 108 62 94 72 54 56 14Z" fill="#4A1218"/>
      <path d="M78 24C62 54 68 100 92 112 112 92 112 52 98 26Z" fill="#5F1A22"/>
      <path d="M60 190C44 170 20 164 8 170 20 190 44 196 60 190Z" fill="#6C7A3A"/>
    </symbol>
    <symbol id="face-f" viewBox="0 0 100 120">
      <ellipse cx="50" cy="62" rx="44" ry="54" fill="#4A1218"/>
      <ellipse cx="50" cy="64" rx="36" ry="46" fill="#ECE8E4"/>
      <ellipse cx="50" cy="66" rx="22" ry="29" fill="#F2B79A"/>
      <circle cx="42" cy="62" r="2.2" fill="#4A1218"/><circle cx="58" cy="62" r="2.2" fill="#4A1218"/>
      <circle cx="38" cy="72" r="4" fill="#EE8E86" opacity=".6"/><circle cx="62" cy="72" r="4" fill="#EE8E86" opacity=".6"/>
      <path d="M43 78q7 6 14 0" stroke="#C0453F" stroke-width="2.4" fill="none" stroke-linecap="round"/>
    </symbol>
    <symbol id="face-m" viewBox="0 0 100 120">
      <ellipse cx="50" cy="62" rx="44" ry="54" fill="#4A1218"/>
      <ellipse cx="50" cy="68" rx="30" ry="40" fill="#F2B79A"/>
      <path d="M18 56C14 24 36 12 54 14 78 14 86 34 82 56 76 44 66 38 50 38 34 38 24 44 18 56Z" fill="#1E1416"/>
      <circle cx="40" cy="64" r="2.2" fill="#4A1218"/><circle cx="60" cy="64" r="2.2" fill="#4A1218"/>
      <circle cx="35" cy="74" r="4" fill="#EE8E86" opacity=".6"/><circle cx="65" cy="74" r="4" fill="#EE8E86" opacity=".6"/>
      <path d="M43 80q7 6 14 0" stroke="#C0453F" stroke-width="2.4" fill="none" stroke-linecap="round"/>
    </symbol>
    <symbol id="fig-f" viewBox="0 0 100 140">
      <path d="M10 140C10 98 28 84 50 84s40 14 40 56Z" fill="#F4F1EE"/>
      <ellipse cx="50" cy="44" rx="30" ry="38" fill="#F4F1EE"/>
      <ellipse cx="50" cy="48" rx="17" ry="22" fill="#F2B79A"/>
      <circle cx="44" cy="46" r="1.8" fill="#4A1218"/><circle cx="56" cy="46" r="1.8" fill="#4A1218"/>
      <path d="M45 56q5 4 10 0" stroke="#C0453F" stroke-width="2" fill="none" stroke-linecap="round"/>
      <circle cx="36" cy="104" r="11" fill="#EFA8A8"/><circle cx="46" cy="100" r="9" fill="#F7C9C9"/>
    </symbol>
    <symbol id="fig-m" viewBox="0 0 100 140">
      <path d="M8 140C8 100 26 86 50 86s42 14 42 54Z" fill="#1F2A44"/>
      <path d="M40 86l10 24 10-24Z" fill="#fff"/>
      <ellipse cx="50" cy="48" rx="21" ry="26" fill="#F2B79A"/>
      <path d="M28 44C24 16 44 10 54 12 74 14 78 30 72 44 66 34 60 30 50 30 40 30 32 34 28 44Z" fill="#1E1416"/>
      <circle cx="43" cy="50" r="1.8" fill="#4A1218"/><circle cx="57" cy="50" r="1.8" fill="#4A1218"/>
      <path d="M45 60q5 4 10 0" stroke="#C0453F" stroke-width="2" fill="none" stroke-linecap="round"/>
    </symbol>
  </defs>
</svg>

{{-- HERO --}}
<header class="hero">
  <svg class="deco" style="transform-origin:100% 0;top:-6px;right:-14px;width:130px;height:154px;transform:rotate(-8deg)"><use href="#anth"/></svg>
  <svg class="pearls" style="top:0;left:0;width:60%;height:140px" viewBox="0 0 200 140"><path d="M-10 6C60 10 90 16 150 40"/></svg>
  <svg class="deco" style="transform-origin:0 100%;left:-10px;bottom:40px;width:96px;height:176px"><use href="#calla"/></svg>
  <svg class="pearls" style="left:0;bottom:0;width:80%;height:150px" viewBox="0 0 280 150"><path d="M-10 90C40 118 90 124 150 134 200 140 240 138 280 130"/></svg>

  <div style="position:relative">
    <h1 id="typed" aria-label="These Kids are Getting Married"><span></span><i></i></h1>
    <div class="faces">
      @foreach([$b,$g] as $pp)
        @php $img = $pp['face'] ?? $pp['photo'] ?? null; @endphp
        @if($img)<span class="face"><img src="{{ asset($img) }}" alt="{{ $pp['nick'] }}"></span>@else<svg><use href="#face-{{ $loop->first ? 'f' : 'm' }}"/></svg>@endif
      @endforeach
    </div>
    <p class="nm">{{ $b['nick'] }} & {{ $g['nick'] }}</p>
    <p class="dt">{{ $date->format('d.m.y') }}</p>
  </div>

  @if($w['music'])
  <button class="star" id="music" type="button"><svg><use href="#star"/></svg>Tap to<br>Play Music</button>
  <audio id="audio" src="{{ asset($w['music']) }}" loop preload="none"></audio>
  @else
  <svg class="deco" style="right:24px;bottom:56px;width:44px;height:44px;color:var(--wine);transform:rotate(-12deg)"><use href="#star"/></svg>
  @endif
</header>

{{-- PASANGAN --}}
<section class="celeb"><div class="col">
  <h2>Celebrating<br>The Wedding of</h2>
  <div class="duo">
    <div class="c cord">@if($b['photo'])<img src="{{ asset($b['photo']) }}" alt="{{ $b['full'] }}">@else<svg><use href="#fig-f"/></svg>@endif</div>
    <div class="c cord">@if($g['photo'])<img src="{{ asset($g['photo']) }}" alt="{{ $g['full'] }}">@else<svg><use href="#fig-m"/></svg>@endif</div>
    <svg class="pearls" style="inset:0;width:100%;height:100%" viewBox="0 0 320 190"><path d="M138 40C176 52 150 108 188 128"/></svg>
    <span class="eye" style="left:calc(45% - 24px);top:16%"></span><span class="eye" style="right:calc(45% - 24px);top:62%"></span>
  </div>
  <div class="person">
    <h3>{{ $b['nick'] }}</h3><p>{{ $b['parents'] }}</p>
    <div class="and">&</div>
    <h3>{{ $g['nick'] }}</h3><p>{{ $g['parents'] }}</p>
  </div>
</div></section>

{{-- HITUNG MUNDUR --}}
<section class="count cord" style="padding-top:62px">
  <svg class="pearls" style="top:0;left:0;width:100%;height:20px" viewBox="0 0 480 20" preserveAspectRatio="none"><path d="M-10 9H490"/></svg>
  <h2>OUR BIG DAY AWAITS</h2>
  <div class="cd" role="timer">
    <div><b id="cd">00</b><span>DAYS</span></div><em>:</em>
    <div><b id="ch">00</b><span>HOURS</span></div><em>:</em>
    <div><b id="cm">00</b><span>MINUTES</span></div><em>:</em>
    <div><b id="cs">00</b><span>SECONDS</span></div>
  </div>
</section>

{{-- KALENDER + ACARA --}}
<section class="cal"><div class="col">
  <div class="calbox cord">
    <div class="ball" style="width:48px;height:48px;right:78px;top:-70px"><i style="height:44px;margin-left:-1px;transform:translateY(0)"></i></div>
    <div class="ball" style="width:84px;height:84px;right:-6px;top:-62px"><i style="height:30px"></i></div>
    <h3>{{ $date->isoFormat('MMMM') }}</h3>
    <div class="grid">
      @foreach(['S','M','T','W','T','F','S'] as $d)<b>{{ $d }}</b>@endforeach
      @for($i=0;$i<$offset;$i++)<span></span>@endfor
      @for($d=1;$d<=$date->daysInMonth;$d++)
        @if($d===$date->day)<span class="hl">{{ sprintf('%02d',$d) }}</span>@else<span>{{ sprintf('%02d',$d) }}</span>@endif
      @endfor
    </div>
  </div>

  <div class="ev" style="margin-top:34px">
    <div class="evs">
    @foreach($w['events'] as $e)
      <div>
      <h3>{{ strtoupper($e['title']) }}</h3>
      <p>{{ $long }}<br>Jam {{ $e['time'] }}</p>
      <small>{{ $e['place'] }}</small>
      </div>
    @endforeach
    </div>
    <iframe class="map" loading="lazy" title="Peta lokasi" src="https://maps.google.com/maps?q={{ $mapq }}&output=embed"></iframe>
    <h3>LOKASI</h3>
    <p>{{ $venue['place'] }}</p>
    <small>{{ $venue['address'] }}</small><br>
    <a class="btn" href="{{ $venue['map'] }}" target="_blank" rel="noopener">Buka peta</a>
  </div>
</div></section>

{{-- HADIAH --}}
<section class="gift">
  <svg class="deco" style="transform-origin:0 0;left:-18px;top:6px;width:120px;height:142px;transform:rotate(-16deg)"><use href="#anth"/></svg>
  <svg class="pearls" style="top:0;left:0;width:60%;height:120px" viewBox="0 0 200 120"><path d="M-10 4C40 8 70 20 100 46"/></svg>
  <div class="col">
    <h2>Wedding<br>Gift</h2>
    <p>Doa restu anda merupakan karunia yang sangat berarti bagi kami. Dan jika memberi adalah ungkapan tanda kasih, anda dapat memberi melalui dibawah ini:</p>
    <div class="stamps">
    @foreach($w['gifts'] as $x)
      <div class="stamp"><b>{{ $x['bank'] }}</b><div class="no">{{ $x['number'] }}</div><span>a/n {{ $x['name'] }}</span>
        <button type="button" data-copy="{{ $x['number'] }}">Salin</button></div>
    @endforeach
    </div>
    @if($w['gift_address'])<p style="margin-top:8px">Kirim kado ke:<br>{{ $w['gift_address'] }}</p>@endif
  </div>
  <svg class="deco" style="transform-origin:100% 100%;right:-6px;bottom:-20px;width:96px;height:176px;transform:scaleX(-1)"><use href="#calla"/></svg>
</section>

{{-- PENUTUP --}}
<section class="quote"><div class="col">
  <div class="faces">
      @foreach([$b,$g] as $pp)
        @php $img = $pp['face'] ?? $pp['photo'] ?? null; @endphp
        @if($img)<span class="face"><img src="{{ asset($img) }}" alt="{{ $pp['nick'] }}"></span>@else<svg><use href="#face-{{ $loop->first ? 'f' : 'm' }}"/></svg>@endif
      @endforeach
    </div>
  <p>{{ $w['quote'] }} ({{ $w['quote_src'] }})</p>
  <h2>See You at . .<br>Our Wedding Day</h2>
</div></section>

{{-- UCAPAN --}}
<section class="wish" id="Wedding" style="padding-top:20px"><div class="col">
  <h2>Ucapan & RSVP</h2>
  @if(session('ok'))<div class="ok" role="status">{{ session('ok') }}</div>@endif
  <form method="POST" action="{{ route('wish.store') }}">
    @csrf
    <div><label for="name">Nama</label><input id="name" name="name" value="{{ old('name', $guest) }}" maxlength="60" required>@error('name')<div class="err">{{ $message }}</div>@enderror</div>
    <div><label for="attendance">Kehadiran</label>
      <select id="attendance" name="attendance"><option value="hadir" @selected(old('attendance')==='hadir')>Insya Allah hadir</option><option value="ragu" @selected(old('attendance')==='ragu')>Belum pasti</option><option value="tidak" @selected(old('attendance')==='tidak')>Maaf, tidak bisa hadir</option></select></div>
    <div><label for="guests">Jumlah tamu</label><input id="guests" type="number" name="guests" min="1" max="5" value="{{ old('guests',1) }}">@error('guests')<div class="err">{{ $message }}</div>@enderror</div>
    <div><label for="message">Ucapan & doa</label><textarea id="message" name="message" maxlength="300" required>{{ old('message') }}</textarea>@error('message')<div class="err">{{ $message }}</div>@enderror</div>
    <button class="btn" type="submit" style="justify-self:start">Kirim ucapan</button>
  </form>
  <div class="list">
    @forelse($wishes as $x)
      <div class="wi"><b>{{ $x->name }}</b><em>{{ ['hadir'=>'Hadir','tidak'=>'Tidak hadir','ragu'=>'Belum pasti'][$x->attendance] }} · {{ $x->created_at->locale('id')->diffForHumans() }}</em><p>{{ $x->message }}</p></div>
    @empty
      <p style="text-align:center">Belum ada ucapan. Jadilah yang pertama menulis.</p>
    @endforelse
  </div>
</div></section>

<footer class="cord">
  <svg class="pearls" style="right:-30px;bottom:-20px;width:150px;height:150px" viewBox="0 0 150 150"><path d="M10 140C60 130 100 90 130 20"/></svg>
  <div class="col"><small>With Love,</small><h2>{{ $b['nick'] }} & {{ $g['nick'] }}</h2></div>
</footer>

<script>
(function(){
  // Teks judul diketik satu kali saat halaman dibuka
  var full='These Kids are Getting Married',el=document.querySelector('#typed span'),caret=document.querySelector('#typed i');
  if(matchMedia('(prefers-reduced-motion:reduce)').matches){el.textContent=full;caret.remove();}
  else{var i=0;(function t(){el.textContent=full.slice(0,++i);if(i<full.length)setTimeout(t,85);else setTimeout(function(){caret.remove()},1200)})();}

  // Musik
  var m=document.getElementById('music'),a=document.getElementById('audio');
  if(m)m.addEventListener('click',function(){if(a.paused){a.play();m.classList.add('on')}else{a.pause();m.classList.remove('on')}});

  // Hitung mundur
  var target=new Date(@json($date->copy()->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'))).getTime();
  function p(n){return String(n).padStart(2,'0')}
  function tick(){var s=Math.floor(Math.max(0,target-Date.now())/1000);
    cd.textContent=p(Math.floor(s/86400));ch.textContent=p(Math.floor(s%86400/3600));cm.textContent=p(Math.floor(s%3600/60));cs.textContent=p(s%60)}
  tick();setInterval(tick,1000);

  // Salin rekening
  document.querySelectorAll('[data-copy]').forEach(function(b){b.addEventListener('click',function(){
    var v=b.dataset.copy,o=b.textContent;
    (navigator.clipboard?navigator.clipboard.writeText(v):Promise.reject()).catch(function(){var x=document.createElement('input');x.value=v;document.body.appendChild(x);x.select();document.execCommand('copy');x.remove()})
      .finally(function(){b.textContent='Tersalin';setTimeout(function(){b.textContent=o},1600)});
  })});
})();
</script>
</body>
</html>