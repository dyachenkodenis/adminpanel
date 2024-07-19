@extends('web.layouts.app')


@section('content')

    <main class="main" data-barba="container" data-barba-namespace="works">
      <section class="section section--offsetVertical">
        <h1 class="visually-hidden">Наши работы</h1>

        <div class="sorted">
          <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1000">
            <a class="sorted__item js-tag active" data-tag="all" href="#all">#Все работы</a>
          </div>
          <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1100">
            <a class="sorted__item js-tag" data-tag="webdesign" href="#webdesign">#Web дизайн</a>
          </div>
          <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1200">
            <a class="sorted__item js-tag" data-tag="graphdesign" href="#graphdesign">#Графический дизайн</a>
          </div>
          <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1300">
            <a class="sorted__item js-tag" data-tag="branding" href="#branding">#Брендинг</a>
          </div>
          <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1400">
            <a class="sorted__item js-tag" data-tag="3dvisually" href="#3dvisually">#3D визуализация</a>
          </div>
          <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1500">
            <a class="sorted__item js-tag" data-tag="smm" href="#smm">#SMM</a>
          </div>
          {{--<div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1600">
            <a class="sorted__item js-tag" data-tag="seo" href="#seo">#SEO</a>
          </div>--}}
  
          <select class="sorted__select">
            <option value="all">#Все работы</option>
            <option value="webdesign">#Web дизайн</option>
            <option value="graphdesign">#Графический дизайн</option>
            <option value="branding">#Брендинг</option>
            <option value="3dvisually">#3D визуализация</option>
            <option value="smm">#SMM</option>
{{-- <option value="seo">#SEO</option> --}} 
          </select>
        </div>

        <div class="works" data-aos="fade-up" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1600">
          {{--<article class="work" data-tag="branding, graphdesign">
            <b>01</b>
            <img src="/static/img/works/asaka/preview.jpg" alt="Ребрендинг Asaka Bank">
            <span class="work__tags">
              <a class="work__tag js-tag" data-tag="branding" href="#branding">#Брендинг</a>
              <a class="work__tag js-tag" data-tag="graphdesign" href="#graphdesign">#Графический дизайн</a>
            </span>
            <div class="work__inner">
              <h2 class="work__title">Ребрендинг Asaka Bank</h2>
              <a class="btn" href="./asaka-bank">
                <span>Подробнее</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </article>
          <article class="work" data-tag="graphdesign">
            <b>02</b>
            <img src="/static/img/works/ex.jpg" alt="Проект 2">
            <span class="work__tags">
              <a class="work__tag js-tag" data-tag="graphdesign" href="#graphdesign">#Графический дизайн</a>
            </span>
            <div class="work__inner">
              <h2 class="work__title">Проект 2</h2>
              <a class="btn" href="./work-inner">
                <span>Подробнее</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </article>
          <article class="work" data-tag="webdesign">
            <b>03</b>
            <img src="/static/img/works/ex.jpg" alt="Проект 3">
            <span class="work__tags">
              <a class="work__tag js-tag" data-tag="webdesign" href="#webdesign">#Web дизайн</a>
            </span>
            <div class="work__inner">
              <h2 class="work__title">Проект 3</h2>
              <a class="btn" href="./work-inner">
                <span>Подробнее</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </article>
          <article class="work" data-tag="branding">
            <b>04</b>
            <img src="/static/img/works/ex.jpg" alt="Проект 4">
            <span class="work__tags">
              <a class="work__tag js-tag" data-tag="branding" href="#branding">#Брендинг</a>
            </span>
            <div class="work__inner">
              <h2 class="work__title">Проект 4</h2>
              <a class="btn" href="./work-inner">
                <span>Подробнее</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </article>
          <article class="work" data-tag="smm">
            <b>05</b>
            <img src="/static/img/works/ex.jpg" alt="Проект 5">
            <span class="work__tags">
              <a class="work__tag js-tag" data-tag="smm" href="#smm">#SMM</a>
            </span>
            <div class="work__inner">
              <h2 class="work__title">Проект 5</h2>
              <a class="btn" href="./work-inner">
                <span>Подробнее</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </article>
          <article class="work" data-tag="seo">
            <b>06</b>
            <img src="/static/img/works/ex.jpg" alt="Проект 6">
            <span class="work__tags">
              <a class="work__tag js-tag" data-tag="seo" href="#seo">#SEO</a>
            </span>
            <div class="work__inner">
              <h2 class="work__title">Проект 6</h2>
              <a class="btn" href="./work-inner">
                <span>Подробнее</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </article>--}}
        </div>
      </section>

      <section class="section section--autoHeight section--notOffset">
        <div class="section__content">
          <h3 class="section__title section__title--lg" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100">Наши услуги</h3>
          <p data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="100">Наши услуги комплексные и в полной мере решают конкретные задачи, которые возникают на разных этапах развития проекта.</p>
        </div>

        <div class="similar">
          <div class="similar__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100">
            <div class="similar__header">
              <b>01</b>
              <span class="similar__title">#SMM</span>
            </div>
            <a href="./smm">
              <span class="visually-hidden">Подробнее</span>
            </a>
          </div>
          <div class="similar__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100">
            <div class="similar__header">
              <b>02</b>
              <span class="similar__title">#SEO</span>
            </div>
            <a href="./seo">
              <span class="visually-hidden">Подробнее</span>
            </a>
          </div>
          <div class="similar__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100">
            <div class="similar__header">
              <b>03</b>
              <span class="similar__title">#Брендинг</span>
            </div>
            <a href="./branding">
              <span class="visually-hidden">Подробнее</span>
            </a>
          </div>
          <div class="similar__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100">
            <div class="similar__header">
              <b>04</b>
              <span class="similar__title">#Web дизайн</span>
            </div>
            <a href="#">
              <span class="visually-hidden">Подробнее</span>
            </a>
          </div>
          <div class="similar__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100">
            <div class="similar__header">
              <b>05</b>
              <span class="similar__title">#Графический дизайн</span>
            </div>
            <a href="#">
              <span class="visually-hidden">Подробнее</span>
            </a>
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