import React, { Component } from 'react'
import { connect } from 'react-redux'
import notie from 'notie'
import { Col, Row, Button, Container } from 'reactstrap'
import { fetchMenuItems } from '../../actions'
import CatalogItem from './CatalogItem/CatalogItem'
import './Cart.less'

class CatalogGrid extends Component {
  constructor(props) {
    super(props)
    this.state = {
      cart: []
    }
  }
  componentWillMount() {
    const { fetchMenuItems } = this.props
    fetchMenuItems()
  }
  orderClick(obj, e) {
    console.log(obj, e)
  }
  onCart(obj) {
    const cart = this.state.cart
    cart.push(obj)
    console.log(obj)
    this.setState({
      cart: cart
    })
  }
  render() {
    const menu = this.props.menu

    return (
      <section className='section-catalog'>
        <div className='the-cart'>
          {this.state.cart.map(e => {
            return (
              <div className='cart-item'>
                <b className='name'>{e.title}</b>
                <span className='price'>{e.price}</span>
              </div>
            )
          })}
        </div>
        <Container fluid>
          <Row>
            {menu.items.map((obj, key) => {
              return (
                <Col key={key} md={4} xs={12}>
                  <CatalogItem onCart={this.onCart.bind(this)} item={obj} />
                </Col>
              )
            })}
          </Row>
        </Container>
      </section>
    )
  }
}

function mapStateToProps(state) {
  const menu = state.menu
  return {
    menu: menu
  }
}

export default connect(
    mapStateToProps,
    { fetchMenuItems }
)(CatalogGrid)
