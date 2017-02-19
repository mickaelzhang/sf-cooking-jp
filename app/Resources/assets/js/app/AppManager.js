import $ from 'jquery'
import AddToFavorite from './Ajax/AddToFavorite'
import FollowUser from './Ajax/FollowUser'
import HamburgerMenu from './HamburgerMenu/HamburgerMenu'

export default class AppManager {
  constructor() {
    console.log('AppManager Init.')

    let html = $('html')

    new HamburgerMenu()

    if (html.hasClass('recipePage')) {
      new AddToFavorite()
    }
    if (html.hasClass('userProfile')) {
      new FollowUser()
    }
  }
}
