import React, { Component } from 'react'
import { connect } from 'react-redux'
import notie from 'notie'
import { Col, Row, Button, Container } from 'reactstrap'
import { fetchMenuItems } from '../../actions'
import CatalogItem from './CatalogItem/CatalogItem'
import Cart from './Cart/Cart'

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
  cartRemove(item) {
    const cart = this.state.cart.filter(f => f.id !== item.id)
//    const that = cart.findIndex(f => f.id === item.id)
//    cart.slice(that, 1)
    this.setState({ cart: cart })
//    console.log(that, cart)
  }
  render() {
    const menu = this.props.menu
    const cart = this.state.cart
    return (
      <section className='section-catalog'>
        {cart && cart.length
          ? <Cart
            onRemove={this.cartRemove.bind(this)}
            items={this.state.cart}
        /> : ''}
        <Container fluid>
          <Row>
            {menu.items.map((obj, key) => {
              return (
                <Col key={key} md={3} xs={12}>
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
