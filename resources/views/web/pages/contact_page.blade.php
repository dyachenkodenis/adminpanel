@extends('web.layouts.app')


@section('content')
    <main class="main" data-barba="container" data-barba-namespace="contact">
      <section class="section contact">
        <h2 class="visually-hidden">Наши контакты</h2>

        <div class="section__content">
          <b class="section__title section__title--lg section__title--notOffsetBottom" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1000">#Краснодар</b>
          <p data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1100">
            ул. Пригородная 177
          </p>
          <p data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1200">
            <a class="link link--offsetRight" href="tel:+79284686130">+7 928 468 61 30</a> |
            <a class="link link--offsetLeft" href="tel:+79950044554">+7 995 004 45 54</a> |
            <a class="link link--offsetLeft" href="tel:88003335353">8 800 333 53 53</a>
          </p>
          <br>
          <b class="section__title section__title--lg section__title--notOffsetBottom" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1000">#Ташкент</b>
          <p data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1100">
            Юнусабадский район, пр-т Амира Темура, д. 129А
          </p>
          <p data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1200">
            <a class="link" href="tel:+998781291199">+998 78 129 11 99</a>
          </p>
          <br>
          <div class="widget" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1600"></div>
        </div>

        <div class="map" data-aos="fade-up-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1600">
          <div class="map__overlay">
            <picture>
              <source srcset="/static/img/map.webp" type="image/webp">
              <img src="/static/img/map.jpg" alt="ALEX Digital Marketing на карте">
            </picture>
            <div class="map__inner"></div>
          </div>
        </div>

        <div class="decor decor--abs">
          <div class="decor__letter decor__letter--01">
            <svg class="decor__svg" width="80"><use xlink:href="#x-letter" /></svg>
          </div>
          <div class="decor__letter decor__letter--02">
            <svg class="decor__svg" width="80"><use xlink:href="#x-letter" /></svg>
          </div>
          <div class="decor__letter decor__letter--03">
            <svg class="decor__svg" width="80"><use xlink:href="#x-letter" /></svg>
          </div>
        </div>
      </section>

      <a class="feedback-link" href="./feedback">
        <span class="circular">Оставить заявку Оставить заявку</span>
        <span class="feedback-link__circle">
          <img class="feedback-link__img" src="/static/img/hand-sm.png" alt="Оставить заявку">
        </span>
      </a>
    </main>
  @endsection