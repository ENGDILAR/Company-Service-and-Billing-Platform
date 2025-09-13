<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مجموعة معمو التجارية</title>
  <link href="{{URL::asset('assets/css/Welcome.css')}}" rel="stylesheet">
</head>
<body>
  <header>
    <h1>مجموعة معمو التجارية</h1>
    <input type="checkbox" id="menu-toggle" hidden>
    <label for="menu-toggle" class="menu-toggle">☰</label>
    <nav>
      <ul id="nav-list">
        <li><a href="#home">الرئيسية</a></li>
        <li><a href="#services">خدماتنا</a></li>
        <li><a href="#products">منتجاتنا</a></li>
        <li><a href="#about">من نحن</a></li>
        <li><a href="#contact">اتصل بنا</a></li>
        <li><a href="{{route('Sigin')}}">تسجيل الدخول</a></li>
      </ul>
    </nav>
  </header>
  <section class="hero" id="home">
    <div class="hero-content">
      <h2>نزرع المستقبل معًا</h2>
      <p>نقدم حلول وخدمات زراعية حديثة تدعم الإنتاج وتضمن الجودة.</p>
    </div>
  </section>

  <section class="services" id="services">
    <h3>خدماتنا</h3>
    <div class="service-box">
      @foreach ($services as $service)
        <div class="card">
          <h4>{{$service->name}}</h4>
          <p>{{$service->description}}</p>
          <p class="price">{{$service->price ? $service->price . "$" : 'بدون سعر' }}</p>
        </div>
      @endforeach
    </div>
  </section>
  <section class="products" id="products">
    <h3>منتجاتنا</h3>
    <div class="product-box">
      @foreach ($products as $product)
        <div class="card">
          @if($product->ImagePath)
            <img src="{{ asset('storage/products/' . $product->ImagePath) }}" 
                 alt="img" class="product-image" loading="lazy">
          @else
            <img src="{{ URL::asset('dashboard/img/default-product.png') }}" 
                 alt="img" class="product-image" loading="lazy">
          @endif
          <h4>{{$product->name}}</h4>
          <p>{{$product->description}}</p>
          <p class="price">{{ $product->price ? $product->price . '$' : 'بدون سعر' }}</p>
        </div>
      @endforeach
    </div>
  </section>
  <section class="about" id="about">
    <h3>من نحن</h3>
    <p>
      مجموعتنا التجارية تأسست لخدمة المجتمع الزراعي والتجاري عبر تقديم خدمات مبتكرة 
      ودعم المزارعين بالتقنيات الحديثة لزيادة الإنتاجية والحفاظ على البيئة.
    </p>
  </section>
<section class="contact" id="contact">
  <h3>اتصل بنا</h3>
  <div class="contact-cards">
    <div class="contact-card">
      <span class="icon">📍</span>
      <h4>الموقع</h4>
      <p>المدينة -  الموقع</p>
    </div>
    <div class="contact-card">
      <span class="icon">📞</span>
      <h4>الهاتف</h4>
      <p>+964 0000000000</p>
    </div>
    <div class="contact-card">
      <span class="icon">✉️</span>
      <h4>البريد الإلكتروني</h4>
      <p>info@example.com</p>
    </div>
    <div class="contact-card">
      <span class="icon">🌐</span>
      <h4>الموقع الإلكتروني</h4>
      <p>www.example.com</p>
    </div>
  </div>
</section>
  <footer>
    <p>جميع الحقوق محفوظة © 2025 مجموعة معمو التجارية</p>
  </footer>
  <script src="{{URL::asset('assets/js/Welcome.js')}}"></script>
</body>
</html>
