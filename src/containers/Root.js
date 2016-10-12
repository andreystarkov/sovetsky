import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import * as LexiActions from '../actions'
import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Sidebar from '../components/Sidebar'
import Footer from '../components/Footer'
import MainCarousel from '../components/MainCarousel'

import { Grid, Row, Col } from 'react-flexbox-grid'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'
import InteriorImages from '../components/InteriorImages'
// import Slider from 'react-slick'
import { default as swal } from 'sweetalert2'
import $ from 'jquery'


class MainHeader extends Component {
  render() {
    return(
      <section className="main-header">
        <Parallax bgImage="/resources/images/main-header/2.jpg" strength={400}>
          <div className="main-header-container">
            <MainLogo />
            <MainNavigation />
          </div>
        </Parallax>
      </section>
    )
  }
}

class DecorativeMenuSection extends Component {
  render(){
    return (
      <section className="decorative-menu-section main-food-text">
      <div className="decorative-left"
           style={{ backgroundImage: 'url(/resources/images/decorative/borsh.png)' }} />
      <div className="decorative-right"
           style={{ backgroundImage: 'url(/resources/images/decorative/carrot.png)' }} />
      <div className="container">
        <div className="row">
          <div className="col-md-4">
          </div>
          <div className="col-md-8">
            <div className="decorative-section-content">
              <h2>Только самое вкусные блюда</h2>
              <p>По мнению ученых, рентгеновская вспышка объясняется тем, что рядом с черной дырой прошла звезда, которая была разорвана приливными силами.</p>

              <button className="button-more button-square-red">Посмотреть меню</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    )
  }
}



class ContactsMain extends Component {
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
export default class LexiTheme extends Component {
    render() {
        return (
            <div>
                <MainHeader />
                <InteriorImages />
                <DecorativeMenuSection />
                <MainCarousel />
                <ContactsMain />
{/*                <div className="container">
                    <div className="row">
                        <div className="col-sm-12 blog-main">
                            {this.props.children}
                        </div>
                    </div>
                </div>*/}
                {/*<Footer />*/}
            </div>
        );
    }
}

