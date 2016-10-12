import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Sidebar from '../components/Sidebar'
import Footer from '../components/Footer'
import MainCarousel from '../components/MainCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'

import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'

class MainHeader extends Component {
  render() {
    return(
      <section className="main-header">
        <Parallax bgImage="/resources/images/main-header/1.jpg" strength={400}>
          <div className="main-header-container container">
            <div className="top-phones">
              <b className="phone"><span>(3532)</span> 55-00-57</b>
              <span className="address">г. Оренбург. ул. Просторная 21/1</span>
            </div>

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

export default class Root extends Component {
    render() {
        return (
            <div>
                <MainHeader />
                <InteriorImages />
                <DecorativeMenuSection />
                <MainCarousel />
                <Contacts />
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

