import $ from 'jquery'

export default class FollowUser {
  constructor() {
    this.button = $('.followButton')
    this.hiddenInput = this.button.find('.app_follow_token')

    // URL for AJAX call
    this.ajaxUrl = this.hiddenInput.attr('data-href')

    // Get data from the hidden input and split it into relevant data
    this.content = this.hiddenInput.attr('data-content').split("_")

    // DATA SEND THROUGH AJAX
    this.followerId = this.content[0]
    this.followedId = this.content[1]
    this.token = this.hiddenInput.val()

    this.initEvents()
  }

  initEvents() {
    const _ = this

    this.button.on('click', function() {
      $.ajax({
        type: "POST",
        url: _.ajaxUrl,
        data: `follower=${_.followerId}&followed=${_.followedId}&token=${_.token}`,
        success: function(data) {
          console.log(data)
        }
      })
    })
  }
}
