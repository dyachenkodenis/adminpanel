@extends('web.layouts.app')


@section('content')
    <main class="main" data-barba="container" data-barba-namespace="feedback">
      <h1 class="visually-hidden">Обратная связь</h1>

      <div class="section section--offsetVertical feedback">
        <div class="section__content" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1000">
          <b class="section__title section__title--lg">#Оставить заявку</b>
        </div>

        <form class="form" action="/send-smtp/feedback.php" method="post">
          <div class="form__list">
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1100">
              <label>
                <input type="text" name="feedbackName" placeholder="Имя*" required>
                <span class="visually-hidden">Имя*</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1200">
              <label>
                <input type="email" name="feedbackEmail" placeholder="E-mail*" required>
                <span class="visually-hidden">E-mail*</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1300">
              <label>
                <input type="tel" name="feedbackPhone" placeholder="Телефон">
                <span class="visually-hidden">Телефон</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1400">
              <label>
                <textarea name="feedbackMessage" cols="30" rows="10" placeholder="Описание проекта или вопрос"></textarea>
                <span class="visually-hidden">Описание проекта или вопрос</span>
              </label>
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1500">
              <div class="g-recaptcha" data-sitekey="6LeOfu0gAAAAAHrNsQrPoNR2A0H7Ljtvg0SwJ6Gm"></div>
              <button class="btn submit" type="button">
                <span>Отправить сообщение</span>
                <svg class="btn__arrow" width="80"><use xlink:href="#arrow" /></svg>
              </button>
            </div>
          </div>
        </form>

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
      </div>
    </main>
@endsection