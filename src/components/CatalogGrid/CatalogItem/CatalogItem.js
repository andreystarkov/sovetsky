import React from 'react'
import { Button } from 'reactstrap'

import notie from 'notie'
import anime from 'animejs'
import $ from 'jquery'
import { AddCartIcon } from '../../../svg/Cart'
import drawStroke from '../../../animation/drawStroke'
// import store from 'store'
import './CatalogItem.less'

export default class CatalogItem extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      hover: false
    }
  }
  toCart(obj, e) {
    console.log('add: ', obj)
    if (this.props.onCart) this.props.onCart(obj)
    notie.alert({
      type: 'success',
      text: `Добавлено в корзину: ${obj.title}`,
      time: 3
    })

    const path = e.target.querySelectorAll('path')
    anime({
      targets: path,
      translateY: {
        value: [0, '-300px']
      },
      opacity: [1, 0],
      duration: 1300,
      rotate: [0, 10],
      elasticity: anime.random(300, 700)
    })
    // anime({
    //   targets: path,
    //   rotateY: [0, -15],
    //   translateZ: [0, -15],
    //   scale: [1, 1.05]
    // })
  }
  onMouseEnterHandle(e) {
    const path = e.target.querySelectorAll('path')
    drawStroke(path)
    // anime({
    //   targets: path,
    //   rotateY: [0, -15],
    //   translateZ: [0, -15],
    //   scale: [1, 1.05]
    // })
  //  drawStroke(icon)
  //  this.setState({ hover: true })

//    console.log('enter', e.querySelector('.svg-icon path'), $('path', e))
  }
  onMouseLeaveHandle() {
  //  this.setState({ hover: false })
    console.log('leave')
  }
  // <span className='catalog-price'>{obj.price} г.</span>
  // <span className='catalog-weight'>{obj.weight} Р.</span>
  render() {
    const obj = this.props.item
  //  console.log(obj)
    return (
      <div
        id={`item-${obj.image.id}`}
        data-id={obj.image.id}
        className='catalog-item'
        onMouseEnter={this.onMouseEnterHandle.bind(this)}
        onMouseLeave={this.onMouseLeaveHandle.bind(this)}
        style={{backgroundImage: `url(${obj.sizes.thumbnail.source_url})`}}
        >
        <div className='catalog-item-overlay'>
          <div className='catalog-caption'>
            <b className='catalog-name'>{obj.title}</b>
            <span className='catalog-description'>{obj.description}</span>
          </div>
          <div className='catalog-params'>
            <Button
              className='btn-add-cart'
              onClick={this.toCart.bind(this, obj)}
              data-name={obj.title}
              data-price={obj.price}
            > <AddCartIcon />
            </Button>
          </div>
        </div>
        <div className='catalog-img'>
          <img src={obj.sizes.thumbnail.source_url} />
        </div>
      </div>
    )
  }
}
