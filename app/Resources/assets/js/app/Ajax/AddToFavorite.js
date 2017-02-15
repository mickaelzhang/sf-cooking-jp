import $ from 'jquery'

export default class AddToFavorite {
  constructor() {
    this.button = $('.favoriteButton')

    this.userId = this.button.attr('data-user-id')
    this.recipeId = this.button.attr('data-recipe-id')
    this.url = this.button.attr('data-href')

    this.initEvents()
  }

  initEvents() {
    const _ = this

    this.button.on('click', function() {
      $.ajax({
        type: "POST",
        url: _.url,
        data: `u=${_.userId}&r=${_.recipeId}`,
        success: function(data) {
          console.log('_______________________________')
          console.log('SUCCESS')
          console.log(data)

        }
      })
    })
  }
}
