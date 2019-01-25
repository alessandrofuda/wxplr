<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>Wexplore | Giving you the freedom to choose your future</title>
<meta name="Description" content="Wexplore è la prima piattaforma tecnologica di servizi di carriera, consulenza HR e formazione, sia per gli individui che per le aziende, per lo sviluppo di percorsi professionali internazionali." />
<meta property="og:locale" content="it_IT" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Wexplore | Giving you the freedom to choose your future" />
<meta property="og:description" content="Wexplore è la prima piattaforma tecnologica di servizi di carriera, consulenza HR e formazione, sia per gli individui che per le aziende, per lo sviluppo di percorsi professionali internazionali." />
<meta property="og:site_name" content="Wexplore" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="Wexplore è la prima piattaforma tecnologica di servizi di carriera, consulenza HR e formazione, sia per gli individui che per le aziende, per lo sviluppo di percorsi professionali internazionali." />
<meta name="twitter:title" content="Wexplore | Giving you the freedom to choose your future" />
<link rel="apple-touch-icon" sizes="57x57" href="{{url('frontend/landing-page/images/favicons/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{url('frontend/landing-page/images/favicons/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{url('frontend/landing-page/images/favicons/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{url('frontend/landing-page/images/favicons/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{url('frontend/landing-page/images/favicons/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{url('frontend/landing-page/images/favicons/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{url('frontend/landing-page/images/favicons/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{url('frontend/landing-page/images/favicons/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{url('frontend/landing-page/images/favicons/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{url('frontend/landing-page/images/favicons/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{url('frontend/landing-page/images/favicons/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{url('frontend/landing-page/images/favicons/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{url('frontend/landing-page/images/favicons/favicon-16x16.png')}}">
<link rel="manifest" href="{{url('frontend/landing-page/images/favicons/manifest.json')}}">
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#00a04c">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#00a04c">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#00a04c">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{url('frontend/landing-page/images/favicons/ms-icon-144x144.png')}}">

<link rel='stylesheet' href='{{ url('frontend/landing-page/style.min.css') }}' type='text/css' media='all' />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:600|Varela+Round" rel="stylesheet">
<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js?ver=3.2.1'></script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/10.19.0/lazyload.min.js'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-125779621-1');
</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '395106547540931'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=395106547540931&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
</head>

<body>
  <header id="header" class="not-scrolled-header">
    <div class="header-bg"></div>
    <div class="wrapper">
      <div class="wrapper-padded">
        <div id="header-structure">
          <div class="logo">
            <img src="{{url('frontend/landing-page/images/wexplore-logo.svg')}}" alt="Wexplore" />
          </div>
          <div class="hamburger hamburger-typoo">
            <span id="goToSectionOne">Contattaci</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="box-fullscreen test-gradient lazy coverize lazy" data-src="{{url('frontend/landing-page/images/wexplore-cover.jpg')}}"></div>

  <div class="box-fullscreen-fair hide-overflow">

    @if (count($errors) > 0)
        <div class="alert alert-danger" style="border: 1px solid #c84f4f; background-color: #c84f4f; color: #FFF; padding: 30px; border-radius: 5px; margin: 30px; text-align: center;">
            <b>Error</b><br/><br/>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($successMessage = session('success'))
      <div class="alert alert-success" style="display:block; border:1px solid green; padding:2%; margin:2%; margin-top:2%; background-color:#06ad06b3; border-radius:10px; color:#FFFFFF; font-size:20px; text-align:center; margin-top:100px; z-index:99999; position: relative; line-height: 1.4;">
        <span>{!!$successMessage !!}</span>
      </div>
    @endif

    <div class="baloon-1 madscroll-slow" data-scroll-speed="3">
      <div class="no-the-100">
        <img data-src="{{url('frontend/landing-page/images/baloon-1.png')}}" alt="Wexplore" class="lazy" />
      </div>
    </div>

    <div class="baloon-2 madscroll-slow bg-8" data-scroll-speed="4">
    </div>

    <div class="baloon-3 madscroll-fast" data-scroll-speed="3">
      <div class="no-the-100">
        <img data-src="{{url('frontend/landing-page/images/baloon-3.png')}}" alt="Wexplore" class="lazy" />
      </div>
    </div>
    <div class="fullscreen-cta fullscreen-cta-center">
      <div class="wrapper">
        <div class="wrapper-padded">
          <div class="wrapper-padded-more">
            <div class="madscroll-slow aligncenter" data-scroll-speed="6">
              <h1 class="txt-8 allupper">Giving you the freedom to choose your future</h1>
              <h2 class="txt-8 allupper">#YourNextChange</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="wrapper bg-8">
  <div class="wrapper-padded-more">
    <div class="block-spacing">
      <h3 class="aligncenter">
        <span class="text-shadow underline">
          Wexplore è la prima piattaforma tecnologica di servizi di carriera, consulenza HR  e formazione, sia per gli individui che per le aziende, per lo sviluppo di percorsi professionali internazionali.
        </span>
      </h3>
    </div>
  </div>
</div>

<div class="wrapper bg-10">
  <div class="wrapper-padded-more">
    <div class="block-spacing aligncenter">
      <div class="image-icon">
        <div class="no-the-100">
          <img data-src="{{url('frontend/landing-page/images/wexplore-screen.svg')}}" alt="Wexplore" class="lazy" />
        </div>
      </div>

      <h4 class="txt-8">
        La nostra piattaforma fornisce servizi di carriera digitali tramite VIC – il nostro Virtual International Consultant, e-learning e consulenza, in un mix unico di intelligenza artificiale e relazione umana, content creation, blockchain e multiculturalità.
      </h4>
    </div>
  </div>
</div>

<div class="wrapper bg-8">
  <div class="wrapper-padded-more">
    <div class="block-spacing aligncenter">

      <div class="image-icon">
        <div class="no-the-100">
          <img data-src="{{url('frontend/landing-page/images/wexplore-world.svg')}}" alt="Wexplore" class="lazy" />
        </div>
      </div>

      <h3 class="aligncenter">
          Vogliamo offrire ai neolaureati, ai professionisti e alle aziende la libertà di scegliere il loro futuro e affrontare le sfide globali del mercato del lavoro: per questo mettiamo a disposizione più di 30 anni di esperienza nei servizi di carriera, un network internazionale costituito da più di 50 Paesi nel mondo e una strategia che combina i vantaggi della tecnologia con l’insostituibile competenza umana.
      </h3>
    </div>
  </div>
</div>

<div class="wrapper bg-6 hide-overflow">
  <div class="baloon-4 madscroll-slow" data-scroll-speed="3">
    <div class="no-the-100">
      <img data-src="{{url('frontend/landing-page/images/baloon-1.png')}}" alt="Wexplore" class="lazy" />
    </div>
  </div>

  <div class="baloon-5 madscroll-slow bg-10" data-scroll-speed="5"></div>

  <div class="baloon-7 madscroll-slow" data-scroll-speed="6">
    <div class="no-the-100">
      <img src="{{url('frontend/landing-page/images/baloon-1.png')}}" alt="Wexplore" class="" />
    </div>
  </div>

  <div class="baloon-8 madscroll-slow bg-2" data-scroll-speed="4"></div>

  <div class="wrapper-padded-more">
    <div class="block-spacing aligncenter">

      <h2 class="allupper">Global Orientation Test</h2>

      <h3 class="aligncenter">
        Inizia il viaggio per scoprire di più su di te: che tipo di società e quali paesi corrispondono meglio ai tuoi valori e le tue preferenze?
      </h3>
      <div class="btn">
        <div class="inner allupper">
          <a href="https://www.wexplore.co/en/register" class="absl"></a>scopri di più
        </div>
      </div>
    </div>
  </div>
</div>











<div class="wrapper bg-11">
  <div class="wrapper-padded-more">
    <div class="block-spacing aligncenter txt-8">

      <h2 class=" allupper">timeline wexplore</h2>

      <div class="timeline-structure">

        <div class="timeline-block">
          <h3 class="allupper">Marzo</h3>
          <h5 class="txt-1">Go live nuovo sito e Wexplore 2.0</h5>
        </div>

        <div class="timeline-block">
          <h3 class="allupper">Aprile</h3>
          <h5 class="txt-1">Release WOW (Wexplore Original webinar) e Blockchain workshop e application</h5>
        </div>

        <div class="timeline-block">
          <h3 class="allupper">Maggio</h3>
          <h5 class="txt-1">Lancio VIC (Virtual International Consultant) per le aree: carriere internazionali, gestione team globali, negoziazioni cross-culturali</h5>
        </div>

        <div class="timeline-block">
          <h3 class="">GIUGNO - onwards</h3>
          <h5 class="txt-1">Ottimizzazione e sviluppo delle linee di servizio Wexplore</h5>
        </div>

      </div>
    </div>
  </div>
</div>








<div class="wrapper bg-8">
  <div class="wrapper-padded-more">
    <div class="block-spacing aligncenter">

      <div class="image-icon">
        <div class="no-the-100">
          <img data-src="{{url('frontend/landing-page/images/wexplore-announcment.svg')}}" alt="Wexplore" class="lazy" />
        </div>
      </div>

      <h3>
        <span class="text-shadow underline">
          Business Development Manager cercasi!
        </span>
      </h3>

      <h4>Se anche tu come noi sei convinto che il mercato globale vada affrontato con un approccio e con degli strumenti nuovi;<br />
        se ti appassiona contribuire alla crescita delle persone verso una realizzazione di sé;<br />
        se ti senti un cittadino del mondo e non poni limiti (né mentali, né geografici) alle culture con cui vuoi entrare in contatto;<br />
        se come noi ritieni che “un obiettivo senza un piano d’azione è solo un desiderio”;<br />
        se hai fame di nuove avventure e sete di conoscere e di farti conoscere, allora vogliamo incontrarti per crescere insieme e raggiungere nuovi livelli.<br />
        Come?</h4>

      <div class="btn">
        <div class="inner allupper">
          <a href="{{url('frontend/landing-page/wexplore-job-application.pdf')}}" class="absl" target="_blank"></a>Scarica la nostra job application
        </div>
      </div>

    </div>
  </div>
</div>





<div class="wrapper bg-6 hide-overflow">
  <div class="baloon-9 madscroll-slow" data-scroll-speed="8">
    <div class="no-the-100">
      <img src="{{url('frontend/landing-page/images/baloon-1.png')}}" alt="Wexplore" />
    </div>
  </div>

  <div id="SectionOne" class="wrapper-padded-more">
    <div class="block-spacing aligncenter">

      <h2 class="allupper">Hai BISOGNO DI INFORMAZIONI?<br/>Contattaci</h2>
      <div class="form-hold">
        <form action="{{ route('landing-page-post')}}" method="POST">
          {{ csrf_field() }}
          <div class="flex-hold flex-hold-3">

            <div class="flex-hold-child">
              <input type="text" name="firstname" placeholder="Nome" value="{{old('firstname')}}" required />
            </div>

            <div class="flex-hold-child">
              <input type="text" name="lastname" placeholder="Cognome" value="{{old('lastname')}}"required />
            </div>

            <div class="flex-hold-child">
              <input type="email" name="email" placeholder="Email" value="{{old('email')}}" required/>
            </div>

          </div>
          <textarea name="message" placeholder="Scrivi il tuo messaggio" required>{{old('message')}}</textarea>
          <div class="alignleft">
            Informativa Privacy*<br />
            <input type="checkbox" name="privacy" required />
            Dichiaro di aver preso visione dell'Informativa sulla privacy
          </div>

          <input type="submit" value="INVIA" />



        </form>
      </div>



    </div>
  </div>
</div>

<footer id="footer" class="bg-8">
  <div class="wrapper">
    <div class="wrapper-padded">
      <div id="footer-structure">
        <div class="logo">
          <img src="{{url('frontend/landing-page/images/wexplore-logo-color.svg')}}" alt="Wexplore" />
        </div>
        <div class="hamburger hamburger-footer-typoo">
          <a href="{{url('informativa-privacy')}}">Privacy Policy</a> | <a href="{{url('cookie-policy')}}">Cookie Policy</a>
        </div>
      </div>
    </div>
  </div>
</footer>

</body>
<script>
  (function() {
    var myLazyLoad = new LazyLoad({
      elements_selector: ".lazy",
      class_loading: "lazy-loading",
      class_loaded: "lazy-loaded"
    });
  }());
</script>
<script type='text/javascript' src="{{url('frontend/landing-page/js/theme-general.min.js')}}" defer='defer'></script>
</html>