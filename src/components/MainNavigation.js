import React, { Component } from 'react'
import { Link } from 'react-router'
import { fetchMenus } from '../actions'
import { connect } from 'react-redux'
import fetch from 'isomorphic-fetch';
import $ from 'jquery'

function postTypes(response){
  console.log('postTypes: ', response);
}

export class MainNavigation extends Component {
    componentWillMount() {
        const { fetchMenus } = this.props;
        fetchMenus();
       // console.log('WTF', a);
    }
    componentDidUpdate(){

    }
    render() {
      var menuData = this.props.menus, classNames = 'nav-item';
      if( menuData.menus.length > 0 ){
        var menuItems = menuData.menus[0].items.map( (obj, key) => {
          if( location.pathname == obj.url) {
            classNames = 'nav-item active';
            console.log('Found: ', location.pathname, obj.url);
          } else classNames = 'nav-item';
          return(
            <Link to={obj.url} className={classNames} key={key}>{obj.title}</Link>
          )
        })
      }
        return (
            <div className="main-navigation-wrapper">
                <nav className="main-navigation">
                    {menuItems}
                </nav>
            </div>
        );
    }
}

function mapStateToProps(state) {
    const menus = state.menus;

  //  console.log('mapStateToProps (MainNavigation_: ', state, menus);

    return {
        menus: menus
    };
}

export default connect(
    mapStateToProps,
    { fetchMenus }
)(MainNavigation);
