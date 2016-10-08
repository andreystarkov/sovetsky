import { bindActionCreators } from 'redux'
import React, { Component } from 'react'
import { connect } from 'react-redux'
import * as LexiActions from '../actions'
import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Sidebar from '../components/Sidebar'
import Footer from '../components/Footer'
import { Grid, Row, Col } from 'react-flexbox-grid'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'
import InteriorImages from '../components/InteriorImages'
import Slider from 'react-slick'
import FormsyText from 'formsy-material-ui/lib/FormsyText'

import '../../less/css/slick.min.css'

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

function prevIcon(){
  return(
    <div className="carousel-prev">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" >
      <g>
        <polygon points="146.883,197.402 45.255,98.698 146.883,0 152.148,5.418 56.109,98.698 152.148,191.98 " />
      </g>
      </svg>
    </div>
  )
}

function nextIcon(){
  return(
    <div className="carousel-next">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
      <g>
        <polygon points="57.179,223.413 51.224,217.276 159.925,111.71 51.224,6.127 57.179,0 172.189,111.71"/>
      </g>
      </svg>
    </div>
  )
}

class Carousel extends Component {
    render() {
      var settings = {
        dots: false,
        infinite: true,
        speed: 500,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: prevIcon(),
        nextArrow: nextIcon()
      };
        return (
            <Slider {...settings} className="food-carousel">
                <div className="food-carousel-item">
                  <img src="/resources/images/samples/1.jpg" />
                  <div className="food-carousel-description">
                    <div className="box">
                      <b>Чудеснейшее блюдо</b>
                      <span>180 р.</span>
                    </div>
                  </div>
                </div>
                <div className="food-carousel-item">
                  <img src="/resources/images/samples/2.jpg" />
                  <div className="food-carousel-description">
                    <div className="box">
                      <b>Чудеснейsasa юдо</b>
                      <span>180 р.</span>
                    </div>
                  </div>
                </div>
                <div className="food-carousel-item">
                  <img src="/resources/images/samples/3.jpg" />
                  <div className="food-carousel-description">
                    <div className="box">
                      <b>Чудеснfdsfейшее блюдо</b>
                      <span>180 р.</span>
                    </div>
                  </div>
                </div>
            </Slider>
        );
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
                <button className="button-square-send">Отправить заявку</button>

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
                <Carousel />
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

