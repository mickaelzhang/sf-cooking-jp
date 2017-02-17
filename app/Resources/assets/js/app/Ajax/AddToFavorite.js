import $ from 'jquery'

export default class AddToFavorite {
  constructor() {
    this.button = $('.favoriteButton')
    this.hiddenInput = this.button.find('.app_favorite_token')
    console.log(this.hiddenInput)
    // URL for AJAX call
    this.ajaxUrl = this.hiddenInput.attr('data-href')

    // Get data from the hidden input and split it into relevant data
    this.content = this.hiddenInput.attr('data-content').split("_")

    // DATA SEND THROUGH AJAX
    this.userId = this.content[0]
    this.recipeId = this.content[1]
    this.token = this.hiddenInput.val()

    this.initEvents()
  }

  initEvents() {
    const _ = this

    this.button.on('click', function() {
      $.ajax({
        type: "POST",
        url: _.ajaxUrl,
        data: `u=${_.userId}&r=${_.recipeId}&token=${_.token}`,
        success: function(data) {
          console.log(data)
        }
      })
    })
  }
}
