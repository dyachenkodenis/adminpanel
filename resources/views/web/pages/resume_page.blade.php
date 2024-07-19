@extends('web.layouts.app')


@section('content')
    <main class="main" data-barba="container" data-barba-namespace="resume">
      <h1 class="visually-hidden">Отправить резюме</h1>

      <div class="section section--offsetVertical resume">
        <div class="section__content" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1000">
          <b class="section__title section__title--lg">#Отправить резюме</b>
        </div>

        <form class="form" action="/send-smtp/resume.php" method="post" enctype="multipart/form-data">
          <div class="form__list">
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1100">
              <label>
                <input type="text" name="resumeName" placeholder="Имя*" required>
                <span class="visually-hidden">Имя*</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1200">
              <label>
                <select name="resumePosition">
                  <option hidden>Выберите должность</option>
                  <option value="SMM-менеджер">SMM-менеджер</option>
                  <option value="Графический дизайнер">Графический дизайнер</option>
                  <option value="Копирайтер/Контент-менеджер">Копирайтер/Контент-менеджер</option>
                </select>
                <span class="visually-hidden">Должность</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1300">
              <label>
                <input type="email" name="resumeEmail" placeholder="E-mail*" required>
                <span class="visually-hidden">E-mail*</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1400">
              <label>
                <input type="tel" name="resumePhone" placeholder="Телефон">
                <span class="visually-hidden">Телефон</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1500">
              <label>
                <span class="form__file">
                  <input type="file" name="resumeFile">
                  <span>Прикрепить резюме</span>
                </span>
                <span class="visually-hidden">Прикрепите файл с резюме</span>
              </label>
            </div>
            <div class="form__item" data-aos="fade-left" data-aos-duration="500" data-aos-offset="100" data-aos-delay="1600">
              <label>
                <textarea name="resumeMessage" cols="30" rows="10" placeholder="Дополнительная информация"></textarea>
                <span class="visually-hidden">Дополнительная информация</span>
              </label>
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-offset="100">
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