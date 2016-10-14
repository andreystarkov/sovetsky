import React, { Component } from 'react'
import { default as swal } from 'sweetalert2'
import $ from 'jquery'
import { Parallax } from 'react-parallax'
//var Cleave = require('cleave.js')
//require('cleave.js/dist/addons/cleave-phone.{country}');

export class TheMap extends Component {
  componentDidMount(){
    console.log('mount');
      DG.then(function() {
          var map = DG.map('map', {
              center: [51.836645,55.159559],
              zoom: 16,
              scrollWheelZoom: false
          });
          DG.marker([51.836645,55.159559]).addTo(map).bindPopup('Ресторан Советский');
      });

  }
  render(){
    return(
      <div>
        <div id="map" className="map"></div>
      </div>
    )
  }
}

export default class Contacts extends Component {
  componentDidMount(){

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
        <section className="section-contacts contacts-bg">
          <Parallax blur={2} bgImage="http://sovetsky.dev/wp-content/uploads/2016/10/DSC01974.jpg" strength={300}>
            <div className="parallax-inner">
              <div className="section-contacts-content container">
                <div className="row">
                  <div className="col-md-12 col-xs-12">
                    <h2>Свяжитесь с нами для заказа</h2>

                    <input id="input-contact-phone" className="input-square" type="text" placeholder="Введите ваш номер телефона" name="phone" />
                    <button id="button-send" className="button-square-send">Отправить заявку</button>


                    <div className="contact-items">
                      <div className="contact-item">
                        <i className="flaticon-phone-call" />
                        <b className="_phone"><span>3532</span> 660001</b>
                        <div className="_subscript">заказ столиков, менеджер</div>
                      </div>
                      <div className="contact-item">
                        <i className="flaticon-phone-call" />
                        <b className="_phone"><span>3532</span> 291129</b>
                        <div className="_subscript">служба доставки</div>
                      </div>
                      <div className="contact-item-address">
                        <i className="flaticon-place-localizer" />
                        <b className="_where">г. Оренбург. Просторная 21/1</b>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </Parallax>
        </section>
    )
  }
}
