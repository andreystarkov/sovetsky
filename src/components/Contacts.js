import React, { Component } from 'react'
import { default as swal } from 'sweetalert2'
import $ from 'jquery'

export default class Contacts extends Component {
  componentDidMount(){
      DG.then(function() {
          var map = DG.map('map', {
              center: [51.836645,55.159559],
              zoom: 16
          });
          DG.marker([51.836645,55.159559]).addTo(map).bindPopup('Ресторан Советский');
      });

      $('#button-send').click( () => {
        swal({
          title: 'Отлично!',
          text: 'Наш менеджер свяжется с вами!',
          confirmButtonText: 'Продолжить',
          type: 'success',
          padding: '50',
          buttonsStyling: false
        })
      });
  }
  render(){
    return(
        <section className="section-contacts">
          <div className="decorative-left"
           style={{ backgroundImage: 'url(/resources/images/decorative/phone.png)' }} />
          <div className="section-contacts-content container">
            <div className="row">
              <div className="col-md-3 col-xs-12"></div>
              <div className="col-md-9 col-xs-12">
                <h2>Свяжитесь с нами для заказа</h2>
                <input className="input-square" type="text" placeholder="Введите ваш номер телефона" name="phone" />
                <button id="button-send" className="button-square-send">Отправить заявку</button>

                <div className="section-contacts-text">
                  <p>Это умозрительное описание, но, конечно, под ним есть строгие формулы, которые доказывают, что шифрование с одноразовыми блокнотами не взламывается. </p>
                </div>

                <div className="section-contacts-phone">
                  <span className="phone_">(3532) 55-00-57</span>
                  <span className="address_">г. Оренбург. ул. Просторная 21/1</span>
                </div>
              </div>
            </div>
          </div>
          <div id="map" className="map"></div>
        </section>
    )
  }
}
