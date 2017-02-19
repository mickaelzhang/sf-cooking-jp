import $ from 'jquery'

export default class HamburgerMenu {
  constructor() {
    console.log('Hamburger Menu loaded')
    this.button = $('.hamburgerMenu__icon')
    this.elm = $('.hamburgerMenu')

    this.initEvents()
  }
  initEvents() {
      const _ = this

      this.button.on('click', function() {
          _.elm.toggleClass('visible')
      })
  }

}
