import $ from 'jquery'
import AddToFavorite from './Ajax/AddToFavorite'
import FollowUser from './Ajax/FollowUser'

export default class AppManager {
  constructor() {
    console.log('AppManager Init.')

    let html = $('html')

    if (html.hasClass('recipePage')) {
      new AddToFavorite()
    }
    if (html.hasClass('userProfile')) {
      new FollowUser()
    }
  }
}
