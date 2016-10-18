import React, { Component } from 'react'
import Slider from 'react-slick'
import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Sidebar from '../components/Sidebar'
import Footer from '../components/Footer'
import MainCarousel from '../components/MainCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'
import { prevIcon, nextIcon } from '../svg/controls'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'
import $ from 'jquery'
require('jquery-scrollify')

var sliderSettings = {
  dots: false,
  infinite: true,
  speed: 1500,
  autoplay: true,
  slidesToShow: 1,
  pauseOnHover: false,
  accessibility: false,
  arrows: false,
  autoplaySpeed: 5000,
  fade: true,
  slidesToScroll: 1,
  prevArrow: prevIcon(),
  nextArrow: nextIcon()
};


class MainHeader extends Component {
  render() {
    return(
      <section className="main-header">
        <div className="top-header-overlay">
          <div className="main-header-container container">
            <div className="top-phones">
              <b className="phone"><span>(3532)</span> 55-00-55</b>
              <span className="address">г. Оренбург. ул. Просторная 21/1</span>
            </div>
            <MainLogo />
            <MainNavigation />
          </div>
        </div>
        <Slider {...sliderSettings} className="food-carousel interior-carousel">
          <div>
            <Parallax bgImage="http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/wp-content/uploads/2016/10/M26A0020.jpg" strength={300} />
          </div>
          <div>
            <Parallax bgImage="http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/wp-content/uploads/2016/10/M26A0027.jpg" strength={300} />
          </div>
          <div>
            <Parallax bgImage="http://xn----7sbhjdshgxidscmfdhj.xn--p1ai/wp-content/uploads/2016/10/2-1.jpg" strength={300} />
          </div>
        </Slider>
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

export default class Root extends Component {
    componentDidMount(){

      console.log('ROOT', this.props);





    }

    componentWillUnmount(){
      //$.scrollify.destroy();
    }

    render() {
        return (
            <div>
                <section id="index-top" className="section-index-top index-scroll-section" data-index-section-name="index-top">
                  <MainHeader className="index-scroll-section" />
                </section>
                <section className="index-scroll-section" data-index-section-name="index-interior">
                  <InteriorImages className="index-scroll-section" />
                </section>
                <section className="index-scroll-section" data-index-section-name="index-menu">
                  <DecorativeMenuSection />
                </section>
                <section className="index-scroll-section" data-index-section-name="index-carousel">
                <MainCarousel />
                </section>
                <section className="index-scroll-section" data-index-section-name="index-contacts">
                <Contacts  />
                </section>

            </div>
        );
    }
}


