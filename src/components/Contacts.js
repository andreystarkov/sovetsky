import React, { Component } from 'react'
import { default as swal } from 'sweetalert2'
import $ from 'jquery'
import { Parallax } from 'react-parallax'
import aniItemsRandom from '../animation/aniItemsRandom'
import drawPath from '../animation/drawPath'
import Waypoint from 'react-waypoint'
import {api, swalSettings} from '../config'
import {getUserProfile, addUserProfile} from '../etc'

export class TheMap extends Component {
  componentDidMount() {
    DG.then(function() {
      const map = DG.map('map', {
        center: [51.836645, 55.159559],
        zoom: 15,
        dragging: false,
        scrollWheelZoom: false
      })
      DG.marker([51.836645, 55.159559]).addTo(map).bindPopup('Ресторан Советский')
    })
  }
  render() {
    return (
      <div id='map-container'>
        <div id='map' className='map' />
      </div>
    )
  }
}

class ContactsComposition extends Component {
  render() {
    return (
      <div className='ani-icon-composition'>
        <div className='ani-icon ani-icon-map'>
          <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 495 495'>
            <path fill='#FFCD00' d='M330 0v70c10.62 0 20.79 1.954 30.18 5.512L412.29 23.4l44.044 12.524-62.643 62.643c13.503 15.11 21.725 35.035 21.725 56.847 0 14.55-3.798 28.913-10.84 41.56L495 287.4V46.92L330 0zM330 382.256v28l52.852 52.853L495 495V343.968l-63.356-63.356M330 325.688l73.36-73.36-23.028-23.028L330 292.58' />
            <path fill='#FFDA44' d='M316 396.257l14 14v-28M244.06 380.885l-79.07 79.07V495l154.11-43.82-3.695 1.05M272.266 219.993L206 286.258l81.716 81.714L330 325.688V292.58M204.107 231.584l-32.04-32.04-7.077 7.08V270.7M215.776 352.6l-38.06-38.058-12.726 12.727v76.118M164.99 98.084v37.814l67.4 67.4 17.744-17.742c-3.627-9.595-5.55-19.82-5.55-30.14C244.585 108.312 282.9 70 330 70V0L191.048 39.51l45.435-12.92-71.493 71.494z' />
            <path fill='#FFCD00' d='M164.99 206.624L0 371.614v64.076L164.99 270.7M164.99 327.27L34.397 457.86l59.265 16.854 71.328-71.328M117.8 145.276L0 263.074v51.973L143.784 171.26M137.705 487.24l-8.054-2.29L164.99 495v-35.044M146.083 116.99l18.907 18.91V98.083M0 0v206.506L160.782 45.723' />
            <path fill='#FFE477' d='M397.02 208.32L380.33 229.3l23.028 23.028-115.644 115.644L206 286.257l66.266-66.265-9.253-11.633c-5.47-6.917-9.79-14.634-12.88-22.804L232.392 203.3l-86.307-86.308 18.907-18.907 71.493-71.493-45.435 12.918-26.058 7.41-4.208-1.197L0 206.506v56.568l117.8-117.8 25.984 25.986L0 315.047v56.57l164.99-164.993 7.078-7.078 32.04 32.04L0 435.69v12.39l34.397 9.782L164.99 327.27l12.727-12.728 38.06 38.06-50.787 50.785-71.328 71.328 35.988 10.234 8.055 2.29 27.285-27.285 79.07-79.07 71.345 71.343 3.694-1.05 10.9-3.1 52.853 15.03L316 396.257l115.644-115.645L495 343.968V287.4l-90.425-90.425c-2.208 3.964-4.726 7.765-7.556 11.345zM393.69 98.568l62.644-62.643L412.29 23.4l-52.11 52.11c12.964 4.915 24.432 12.896 33.51 23.058z' />
            <path fill='#CD2A00' d='M330 123.573c17.553 0 31.842 14.28 31.842 31.842 0 17.553-14.29 31.842-31.842 31.842V292.58l50.332-63.28 16.687-20.98c2.83-3.58 5.348-7.38 7.555-11.345 7.042-12.647 10.84-27.008 10.84-41.56 0-21.813-8.222-41.736-21.724-56.847-9.078-10.16-20.546-18.143-33.51-23.056C350.79 71.954 340.62 70 330 70v53.573z' />
            <path fill='#D8D7DA' d='M361.842 155.415c0-17.56-14.29-31.842-31.842-31.842v63.683c17.553 0 31.842-14.288 31.842-31.84z' />
            <path fill='#FF3501' d='M244.585 155.415c0 10.322 1.922 20.546 5.55 30.14 3.088 8.172 7.408 15.888 12.878 22.804l9.253 11.632L330 292.582V187.256c-17.56 0-31.842-14.29-31.842-31.842 0-17.56 14.28-31.842 31.842-31.842V70c-47.102 0-85.415 38.313-85.415 85.415z' />
            <path fill='#FFF' d='M330 123.573c-17.56 0-31.842 14.28-31.842 31.842 0 17.553 14.28 31.842 31.842 31.842v-63.684z' />
          </svg>
        </div>
        <div className='ani-icon ani-icon-phone'>
          <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
            <g fill='#a82316'>
              <path d='M495.367 59.716C470.172 29.406 348.242 3.776 256 3.776S41.828 29.405 16.633 59.715C-2.19 82.36.086 136.916.086 136.916s29.07 3.484 59.463 3.484 59.462-3.484 59.462-3.484v-47.43H392.99v47.43s29.068 3.485 59.462 3.485c30.393 0 59.463-3.483 59.463-3.483s2.274-54.557-16.548-77.2zM470.607 349.24v150.45H41.392V349.24L256 303.73' />
            </g>
            <path fill='#cf3d2f' d='M343.63 117.202L470.608 349.24H41.392l126.976-232.038V68.926c0-3.277 2.65-5.94 5.928-5.94h22.426c3.277 0 5.928 2.663 5.928 5.94v48.276h106.7V68.926c0-3.277 2.65-5.94 5.928-5.94h22.426c3.277 0 5.928 2.663 5.928 5.94v48.276z' />
            <path fill='#891f15' d='M481.497 508.225H30.502c-4.713 0-8.533-3.82-8.533-8.533s3.82-8.533 8.532-8.533h450.996c4.713 0 8.533 3.82 8.533 8.532s-3.82 8.533-8.533 8.533z' />
            <circle cx='256' cy='233.221' r='83.365' fill='#a82316' />
            <g fill='#FFF'>
              <circle cx='256' cy='191.818' r='8.533' />
              <circle cx='220.148' cy='212.514' r='8.533' />
              <circle cx='220.148' cy='253.918' r='8.533' />
              <circle cx='256' cy='274.625' r='8.533' />
              <circle cx='291.851' cy='253.918' r='8.533' />
              <circle cx='291.851' cy='212.514' r='8.533' />
              <path d='M402.337 403.283H109.662c-4.713 0-8.533-3.82-8.533-8.533s3.82-8.533 8.532-8.533h292.675c4.713 0 8.533 3.82 8.533 8.533s-3.82 8.533-8.533 8.533z' />
            </g>
            <g fill='#FFCE78'>
              <circle cx='128.159' cy='447.215' r='18.497' />
              <circle cx='213.39' cy='447.215' r='18.497' />
              <circle cx='298.61' cy='447.215' r='18.497' />
              <circle cx='383.841' cy='447.215' r='18.497' />
            </g>
          </svg>
        </div>
      </div>
    )
  }
}

export default class Contacts extends Component {
  componentDidMount() {
    var user = getUserProfile()
    if (user.phone) {
      $('#input-contact-phone').val(user.phone)
    }
  }
  _handleWaypointEnter() {
    aniItemsRandom('.ani-icon-map path, .ani-icon-map ellipse, .ani-icon-map circle')

    setTimeout(() => {
      aniItemsRandom('.ani-icon-phone path, .ani-icon-phone ellipse, .ani-icon-phone circle')
    }, 500)

    // drawPath('.icon-manager path');
    // drawPath('.icon-delivery path');
  }
  _handleWaypointLeave() {

  }
  onSend(e) {
    const phone = $('#input-contact-phone').val()

    // console.log('phone: ', phone)

    if (phone) {
      $.get(api.mail + '?phone=' + phone, response => {
        swal({
          type: 'success',
          title: 'Спасибо за заявку!',
          html: 'В ближайшее время мы позвоним вам на номер ' + phone + '.',
          ...swalSettings
        })

        const user = {
          phone: phone
        }

        addUserProfile(user)
      })
    }
  }
  render() {
    return (
      <section className='decorative-menu-section main-food-text'>
        <Waypoint
          onEnter={this._handleWaypointEnter}
          onLeave={this._handleWaypointLeave}
      />

        <div className='container'>
          <div className='row'>
            <div className='col-md-4 col-xs-12 icon-composition-container'>
              <ContactsComposition />
            </div>
            <div className='col-md-8 col-xs-12'>
              <div className='decorative-section-content'>
                <h2>Свяжитесь с нами</h2>

                <div className='input-group-send'>
                  <input id='input-contact-phone' className='input-square' type='text' placeholder='Введите ваш номер телефона' name='phone' />
                  <button onClick={this.onSend.bind(this)} id='button-send' className='button-square-send'>Отправить заявку</button>
                </div>

                <div className='contact-items'>
                  <div className='contact-item'>
                    <div className='svg-icn icon-manager'>
                      <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 463 463'>
                        <path d='M183.5 167c4.142 0 7.5-3.358 7.5-7.5v-8c0-4.142-3.358-7.5-7.5-7.5-4.142 0-7.5 3.358-7.5 7.5v8c0 4.142 3.358 7.5 7.5 7.5zM279.5 167c4.142 0 7.5-3.358 7.5-7.5v-8c0-4.142-3.358-7.5-7.5-7.5-4.142 0-7.5 3.358-7.5 7.5v8c0 4.142 3.358 7.5 7.5 7.5zM203.414 215.902c6.942 4.51 17.18 7.098 28.086 7.098s21.145-2.587 28.086-7.098c3.473-2.257 4.46-6.902 2.203-10.375-2.258-3.474-6.903-4.46-10.376-2.203-4.505 2.928-11.95 4.676-19.914 4.676s-15.408-1.748-19.914-4.676c-3.474-2.257-8.118-1.27-10.375 2.203-2.256 3.473-1.27 8.118 2.204 10.375z' />
                        <path d='M390.52 295.267L303 266.094V238.69l1.376-.814c18.89-11.162 30.624-32.474 30.624-55.62V145.36c.417-.206.83-.425 1.23-.674 4.24-2.62 6.77-7.157 6.77-12.14V97.47c21.202-38.69 8.326-89.672 7.76-91.856-.504-1.936-1.76-3.59-3.487-4.596-1.73-1.007-3.788-1.28-5.718-.762-21.25 5.706-48.183 3.734-74.23 1.83C228.72-.74 188.803-3.66 162.745 17.697c-5.826 4.776-9.844 10.37-12.613 15.76l-5.88.978c-22.817 3.804-38.288 25.462-34.485 48.28l8.83 52.972c.75 4.514 3.522 8.294 7.6 10.37.59.3 1.193.546 1.804.76v35.438c0 23.145 11.735 44.457 30.625 55.62l1.376.812v27.405l-87.52 29.173C53.052 301.743 40 319.852 40 340.33v91.17c0 17.37 14.13 31.5 31.5 31.5h320c17.37 0 31.5-14.13 31.5-31.5v-91.17c0-20.478-13.052-38.587-32.48-45.063zM124.562 80.253c-2.328-13.972 6.59-27.266 20.12-30.6-.575 3.2-.667 5.304-.677 5.578-.142 3.953 2.81 7.336 6.744 7.73 3.932.395 7.5-2.33 8.148-6.23l1.287-7.728c1.484-5.662 4.785-13.73 12.07-19.7 21.425-17.564 56.665-14.985 93.975-12.256 24.378 1.783 49.498 3.622 71.474-.542 2.59 14.73 6.382 49.324-8.687 75.225-.666 1.143-1.017 2.445-1.017 3.77v35.865l-13.25-6.625c-2.313-1.156-3.75-3.48-3.75-6.067v-8.89C311 97.774 301.228 88 289.217 88H173.783C161.773 88 152 97.772 152 109.783v8.89c0 2.585-1.437 4.91-3.75 6.066l-15.022 7.51-8.666-51.997zM143 182.257v-38.122l11.958-5.98c7.428-3.713 12.042-11.18 12.042-19.483v-8.89c0-3.74 3.043-6.782 6.783-6.782h115.434c3.74 0 6.783 3.043 6.783 6.783v8.89c0 8.303 4.614 15.77 12.042 19.483l11.958 5.98v38.12c0 17.866-8.91 34.23-23.255 42.706l-41.33 24.423c-7.325 4.328-15.592 6.615-23.92 6.615-8.318 0-16.585-2.288-23.91-6.615l-41.33-24.423C151.91 216.486 143 200.122 143 182.257zM239.5 296h-16c-4.638 0-8.795 2.058-11.638 5.296l-23.227-11.613L175 269.23V247.55l24.955 14.746c9.633 5.693 20.54 8.702 31.55 8.702 11 0 21.906-3.01 31.54-8.7L288 247.55v21.677l-13.643 20.463-23.215 11.607c-2.843-3.24-7.002-5.3-11.642-5.3zm.5 15.5v16c0 .275-.224.5-.5.5h-16c-.276 0-.5-.225-.5-.5V312c.012-.182.01-.365.01-.547.025-.253.23-.453.49-.453h16c.276 0 .5.225.5.5zm-32 4.635v6.73l-32.276 16.138c-.093.047-.25.125-.486-.02-.238-.15-.238-.323-.238-.427v-38.11c0-.105 0-.28.237-.427.237-.147.394-.07.486-.022L208 316.135zm47 .007l32.29-16.146c.094-.046.25-.125.487.02.237.148.237.322.237.427v38.11c0 .105 0 .28-.237.427-.237.146-.394.068-.486.02L255 322.858v-6.715zm-31 131.86H119v-56.5c0-4.142-3.358-7.5-7.5-7.5-4.142 0-7.5 3.358-7.5 7.5V448H71.5c-9.098 0-16.5-7.402-16.5-16.5v-91.17c0-14.01 8.93-26.4 22.223-30.832l87.215-29.07 4.113 6.168c-.405.205-.806.42-1.198.663-4.603 2.844-7.35 7.773-7.35 13.185v38.11c0 5.412 2.747 10.34 7.35 13.187 2.505 1.548 5.317 2.33 8.14 2.33 2.363 0 4.735-.548 6.94-1.65l29.43-14.716c2.844 3.238 7 5.296 11.64 5.296h.5v105zM408 431.5c0 9.098-7.402 16.5-16.5 16.5H359v-56.5c0-4.142-3.358-7.5-7.5-7.5-4.142 0-7.5 3.358-7.5 7.5V448H239V343h.5c4.64 0 8.8-2.06 11.642-5.3l29.44 14.72c2.207 1.103 4.578 1.65 6.942 1.65 2.822 0 5.634-.78 8.14-2.33 4.602-2.844 7.35-7.773 7.35-13.185v-38.11c0-5.412-2.748-10.34-7.35-13.187-.397-.244-.802-.462-1.212-.668l4.11-6.164 87.214 29.07C399.07 313.93 408 326.32 408 340.33v91.17z' />
                        <path d='M311.5 376h-40c-8.547 0-15.5 6.953-15.5 15.5v24c0 8.547 6.953 15.5 15.5 15.5h40c8.547 0 15.5-6.953 15.5-15.5v-24c0-8.547-6.953-15.5-15.5-15.5zm.5 39.5c0 .275-.224.5-.5.5h-40c-.276 0-.5-.225-.5-.5v-24c0-.275.224-.5.5-.5h40c.276 0 .5.225.5.5v24z' />
                      </svg>
                    </div>
                    <b className='_phone'><span>3532</span> 660001</b>
                    <div className='_subscript'>заказ столиков, менеджер</div>
                  </div>
                  <div className='contact-item icon-delivery'>
                    <div className='svg-icn'>
                      <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 463 463'>
                        <path d='M367.372 142.726C366.96 134.47 360.16 128 351.892 128H298.12l-12.974-82.17C280.953 19.275 258.396 0 231.49 0c-26.885 0-49.442 19.274-53.635 45.83L164.88 128h-53.77c-8.268 0-15.068 6.47-15.48 14.726l-15.2 304c-.212 4.22 1.337 8.396 4.25 11.457S91.684 463 95.91 463h271.18c4.226 0 8.32-1.756 11.23-4.817s4.462-7.236 4.25-11.457l-15.198-304zm-174.7-94.555c3.036-19.22 19.36-33.17 38.84-33.17 19.457 0 35.783 13.95 38.818 33.17L282.935 128H180.068l12.604-79.83zm174.78 399.675c-.147.155-.303.155-.36.155H95.91c-.06 0-.215 0-.363-.155-.15-.155-.14-.31-.138-.37l15.2-304c.013-.266.233-.475.5-.475h51.402l-2.42 15.33c-.647 4.092 2.146 7.932 6.237 8.578.397.063.79.093 1.18.093 3.626 0 6.815-2.635 7.4-6.33L177.7 143h107.603l2.79 17.67c.646 4.09 4.483 6.88 8.578 6.238 4.092-.646 6.885-4.486 6.24-8.578L300.49 143h51.4c.268 0 .487.21.5.476l15.2 304c.003.058.01.213-.137.37z' />
                        <path d='M231.5 192c-4.14 0-7.5 3.357-7.5 7.5V240h-9v-40.5c0-4.143-3.357-7.5-7.5-7.5-4.14 0-7.5 3.357-7.5 7.5V240h-9v-40.5c0-4.143-3.357-7.5-7.5-7.5-4.14 0-7.5 3.357-7.5 7.5v56c0 12.958 10.543 23.5 23.5 23.5h.5v128.5c0 4.143 3.36 7.5 7.5 7.5 4.143 0 7.5-3.357 7.5-7.5V279h.5c12.96 0 23.5-10.542 23.5-23.5v-56c0-4.143-3.357-7.5-7.5-7.5zm-7.5 63.5c0 4.687-3.812 8.5-8.5 8.5h-16c-4.686 0-8.5-3.813-8.5-8.5v-.5h33v.5zM287.72 206.754c-.817-8.162-7.618-14.317-15.82-14.317-8.768 0-15.9 7.133-15.9 15.9V407.5c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5V359h6.717c6.653 0 13.02-2.837 17.47-7.782s6.6-11.576 5.9-18.19L287.72 206.753zm-3.684 134.432C282.403 343 280.16 344 277.718 344H271V208.336c0-.496.403-.9.9-.9.463 0 .848.35.898.854l13.372 126.316c.257 2.427-.5 4.764-2.134 6.58z' />
                      </svg>
                    </div>
                  </div>
                  <div className='contact-item-address'>
                    <i className='flaticon-place-localizer' />
                    <b className='_where'>г. Оренбург. Просторная 21/1</b>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    )
  }
}
