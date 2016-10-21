import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { browserHistory } from 'react-router'
import { Provider } from 'react-redux'
import { Router, Route, IndexRoute } from 'react-router'
import configureStore from './store/configureStore'
import Root from './containers/Root'

import PostContainer from './containers/PostContainer'

import InteriorPage from './pages/InteriorPage'
import MenuPage from './pages/MenuPage'
import ContactsPage from './pages/ContactsPage'

import First from './containers/First'
import PageContainer from './containers/PageContainer'
import IndexPage from './pages/IndexPage'
import GalleryPage from './pages/GalleryPage'

import '../sass/bootstrap.css'
import '../sass/bootstrap-blog.css'
import '../sass/sweetalert2.scss'

import '../resources/fonts/flaticon.css'
import '../resources/fonts/styles.css'
import '../less/styles.less'

const store = configureStore();
let rootElement = document.getElementById('root');

ReactDOM.render(
    <Provider store={store}>
        <Router history={browserHistory}>
          <Route path="/" component={PageContainer}>
              <IndexRoute component={IndexPage} />
              <Route path="index" component={IndexPage} />
              <Route path="interior" component={InteriorPage} />
              <Route path="delivery" component={MenuPage} />
              <Route path="contacts" component={ContactsPage} />
              <Route path="gallery" component={GalleryPage} />
          </Route>
        </Router>
    </Provider>,
    rootElement
);

