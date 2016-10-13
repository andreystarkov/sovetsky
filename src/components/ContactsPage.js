import React, { Component } from 'react'

import MainNavigation from '../components/MainNavigation'
import Header from '../components/Header'
import Sidebar from '../components/Sidebar'
import Footer from '../components/Footer'
import InteriorCarousel from '../components/InteriorCarousel'
import Contacts from '../components/Contacts'
import InteriorImages from '../components/InteriorImages'
//import Menu from 'react-burger-menu'
import { Parallax } from 'react-parallax'
import MainLogo from '../svg/MainLogo'

var Menu = require('react-burger-menu').push;
//   width="512px" height="512px"

class MainHeader extends Component {
  render() {
    return(
      <section className="main-header">
        <Parallax bgImage="http://sovetsky.dev/wp-content/uploads/2016/10/DSC01974.jpg" strength={600}>
          <div className="main-header-container container">

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


export default class ContactsPage extends Component {
  render() {
      return (
          <div id="top-wrapper">
            <Menu pageWrapId={ "page-wrapper" }  outerContainerId={ "top-wrapper" } right>
              <MainLogo />
              <MainNavigation />
            </Menu>
            <div id="page-wrapper">
                <div className="page-navigation container">
                  <MainLogo />
                </div>
                <MainHeader />
                <Contacts />
                 <div className="container">
                    <div className="row">
                        <div className="col-sm-12 blog-main">
                            {this.props.children}
                        </div>
                    </div>
                </div>
                <Footer />
            </div>
          </div>
      );
  }
}

