import $ from 'jquery'

export default class AddToFavorite {
  constructor() {
    this.button = $('.favoriteButton')
    this.buttonText = this.button.find('.addToFavorite__text')

    this.buttonTextAdd = 'Ajouter aux favoris'
    this.buttonRemoveAdd = 'Retirer des favoris'

    this.hiddenInput = this.button.find('.app_favorite_token')

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

          if(_.buttonText.data('text') == '0'){
            _.buttonText.text(_.buttonRemoveAdd)
            _.buttonText.data('text', '1')
          }
          else if(_.buttonText.data('text') == '1') {
            _.buttonText.text(_.buttonTextAdd)
            _.buttonText.data('text', '0')
          }

        }
      })
    })
  }
}
