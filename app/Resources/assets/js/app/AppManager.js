import $ from 'jquery'
import AddToFavorite from './Ajax/AddToFavorite'

export default class AppManager {
  constructor() {
    console.log('AppManager Init.')

    let html = $('html')

    if (html.hasClass('recipePage')) {
      new AddToFavorite()
    }
  }
}
