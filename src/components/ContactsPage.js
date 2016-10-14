import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Sidebar from '../components/Sidebar'
import Footer from '../components/Footer'
import InteriorCarousel from '../components/InteriorCarousel'
import {TheMap, Contacts} from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'
//import Menu from 'react-burger-menu'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'
import $ from 'jquery'

var Menu = require('react-burger-menu').push;
//   width="512px" height="512px"

class MainHeader extends Component {
  render() {
    return(
      <section className="main-header contacts-header">
        <Parallax blur={5} bgImage="http://sovetsky.dev/wp-content/uploads/2016/10/DSC01974.jpg" strength={600}>
          <div className="main-header-container container">
            <div className="contact-us">

                <h3>Есть вопросы? Оставьте заявку, наше менеджер перезвонит вам!</h3>
                <input className="input-square" type="text" placeholder="Введите ваш номер телефона" name="phone" />
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

                <button className="button-map" id="scroll-to-map">
                  Посмотреть на карте <i className="flaticon-down-arrow" />
                </button>
            </div>
          </div>
        </Parallax>
      </section>
    )
  }
}

export default class ContactsPage extends Component {
  componentDidMount(){
    $('#scroll-to-map').click(function(){
      $(document.body).animate({
          'scrollTop':  $('#map').offset().top
      }, 1000);
    });
  }
  render() {
      return (
          <div>
            <MainHeader />
          </div>
      );
  }
}

