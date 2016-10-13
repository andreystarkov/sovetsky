import React, { Component } from 'react'
import { Link } from 'react-router'
import { fetchMenus } from '../actions'
import { connect } from 'react-redux'
import fetch from 'isomorphic-fetch';

function postTypes(response){
  console.log('postTypes: ', response);
}

export class MainNavigation extends Component {
    componentWillMount() {
        const { fetchMenus } = this.props;
        fetchMenus();
       // console.log('WTF', a);
    }
    render() {
      var menuData = this.props.menus;

      if( menuData.menus.length > 0 ){
        var menuItems = menuData.menus[0].items.map( (obj, key) => {
          console.log('menus loop: ', obj);
          return(
            <Link to={'/'+obj.object_slug} className="nav-item" key={key} activeClassName="active">{obj.title}</Link>
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

    console.log('mapStateToProps: ', state, menus);

    return {
        menus: menus
    };
}

export default connect(
    mapStateToProps,
    { fetchMenus }
)(MainNavigation);
