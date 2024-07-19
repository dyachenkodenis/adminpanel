@extends('web.layouts.app')


@section('content')

    <main class="main" data-barba="container" data-barba-namespace="vacancy">
      <section class="section vacancy">
        <div class="section__content">
          <h1 class="section__title section__title--lg" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1000">#Открытые вакансии</h1>
          <p data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1100">Мы ищем людей, готовых развиваться вместе с нами. Вы можете ознакомиться с открытыми вакансиями ниже.</p>
        </div>

        <div class="vacancy__wrap accordion">
          <div class="vacancy__box accordion__item" data-opener="accordion-01" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1200">
            <div class="accordion__header">
              <b>01</b>
              <h2 class="vacancy__title">SMM-менеджер</h2>
            </div>
            <button type="button" data-opener="accordion-01">
              <span class="visually-hidden">Показать/скрыть</span>
            </button>
            <div class="accordion__content">
              <div class="vacancy__list">
                <p>Мы ищем SMM-менеджера с опытом на полный рабочий день.</p>
              </div>
              
              <div class="vacancy__list">
                <h3 class="vacancy__subtitle">Задачи:</h3>
                <ul class="list">
                  <li>организация и проведение акций, опросов, внедрение прочих интерактивных плюшек</li>
                  <li>составление медиаплана продвижения проекта в соцсетях</li>
                  <li>запуск и ведение рекламных кампаний на площадках Facebook и Instagram</li>
                  <li>коммуникация с командой</li>
                  <li>общение с аудиторией бренда</li>
                  <li>анализ и подготовка отчетов</li>
                </ul>
              </div>

              <div class="vacancy__list">
                <h3 class="vacancy__subtitle">Обещаем:</h3>
                <ul class="list">
                  <li>работу с проектами, которыми можно гордиться</li>
                  <li>поддержку в развитии и совместный рост</li>
                  <li>классный и душевный коллектив</li>
                  <li>хорошая зарплата</li>
                </ul>
              </div>

              <a class="btn" href="./resume">
                <span>Отправить резюме</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </div>

          <div class="vacancy__box accordion__item" data-opener="accordion-02" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1300">
            <div class="accordion__header">
              <b>02</b>
              <h2 class="vacancy__title">Графический дизайнер</h2>
            </div>
            <button type="button" data-opener="accordion-02">
              <span class="visually-hidden">Показать/скрыть</span>
            </button>
            <div class="accordion__content">
              <div class="vacancy__list">
                <p>Мы ищем специалиста, который работает с графикой и типографикой в соцсетях, умеет разрабатывать айдентику, работать с видео и анимацией. Не боится ТЗ и любит генерировать новые идеи.</p>
              </div>
              
              <div class="vacancy__list">
                <h3 class="vacancy__subtitle">Важно:</h3>
                <ul class="list">
                  <li>полная занятость</li>
                  <li>работа в офисе (в двух шагах от метро «Шахристан»)</li>
                  <li>опыт, навыки и любовь к визуальному контенту</li>
                </ul>
              </div>

              <a class="btn" href="./resume">
                <span>Отправить резюме</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
          </div>

          <div class="vacancy__box accordion__item" data-opener="accordion-03" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1400">
            <div class="accordion__header">
              <b>03</b>
              <h2 class="vacancy__title">Копирайтер/Контент-менеджер</h2>
            </div>
            <button type="button" data-opener="accordion-03">
              <span class="visually-hidden">Показать/скрыть</span>
            </button>
            <div class="accordion__content">
              <div class="vacancy__list">
                <p>Ищем специалиста, который умеет писать просто о сложном и убеждать словом. От нас — возможность роста и получения навыков в интернет-маркетинге, дружный молодой коллектив, уютный современный офис в 2 минутах от метро, чай/кофе.</p>
              </div>
              
              <div class="vacancy__list">
                <h3 class="vacancy__subtitle">Обязанности:</h3>
                <ul class="list">
                  <li>Подготовка материалов для наполнения сайтов проекта</li>
                  <li>Разработка, составление и написание оригинальных текстов (SEO-тексты, тематические статьи, новости, тексты для презентаций и пр.)</li>
                  <li>Создание контента для сайтов компании (описание разделов каталога, тексты блога)</li>
                  <li>Помощь в подготовке контента для социальных сетей (VK, FB, Insta, OK)</li>
                  <li>Оперативное выполнение поставленных руководителем задач</li>
                </ul>
              </div>

              <div class="vacancy__list">
                <h3 class="vacancy__subtitle">Мы предлагаем:</h3>
                <ul class="list">
                  <li>работу с проектами, которыми можно гордиться</li>
                  <li>поддерживающая команда</li>
                  <li>полный рабочий день с полноценными выходными</li>
                  <li>постоянный рост и развитие</li>
                </ul>
              </div>

              <a class="btn" href="./resume">
                <span>Отправить резюме</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </a>
            </div>
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