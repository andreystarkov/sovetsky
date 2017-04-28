import React from 'react'
import { Button } from 'reactstrap'

import notie from 'notie'
import anime from 'animejs'
import Img from '../../Common/Image'
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
    if (this.props.onCart) this.props.onCart(obj)
    notie.alert({
      type: 'success',
      text: `Добавлено в корзину: ${obj.title}`,
      time: 3
    })

    const path = e.target.querySelectorAll('path.spoon')

    // anime({
    //   targets: path,
    //   d: 'M368.911,155.586L234.663,289.834l-70.248-70.248c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17 l85.333,85.333c8.331,8.331,21.839,8.331,30.17,0l149.333-149.333c8.331-8.331,8.331-21.839,0-30.17 S377.242,147.255,368.911,155.586z',
    //   duration: 1000,
    //   easing: 'linear',
    //   scale: 0.9
    // })
  }
  onMouseEnterHandle(e) {
    const path = e.target.querySelectorAll('path')
    drawStroke(path)
  }
  onMouseLeaveHandle() {
    // this.setState({ hover: false })
  }

  handleImageLoaded(e) {
    anime({
      targets: e.target.parentNode.parentNode,
      opacity: {
        value: [0, 1],
        duration: 300
      },
      translateY: {
        value: ['500px', 0],
        duration: 300
      },
      easing: 'easeInOutQuart',
      elasticity: 600
    })
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
        style={{backgroundImage: `url(${obj.sizes.thumbnail.source_url})`, opacity: 0}}
        >
        <div className='catalog-item-overlay'>
          <div className='catalog-caption'>
            <b className='catalog-name'>
              {obj.title}
            </b>
            <span className='catalog-description'>{obj.description}</span>
          </div>
          <div className='catalog-params'>
            <Button
              className='btn-add-cart'
              onClick={this.toCart.bind(this, obj)}
              data-name={obj.title}
              data-price={obj.price}
            >
              <AddCartIcon />
            </Button>
          </div>
        </div>
        <div className='catalog-img'>
          <img
            src={obj.sizes.thumbnail.source_url}
            alt={obj.title}
            onLoad={this.handleImageLoaded.bind(this)}
          />
        </div>
      </div>
    )
  }
}
