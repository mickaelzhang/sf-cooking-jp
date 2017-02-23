import $ from 'jquery'
import AdminManager from './admin/AdminManager'
import AppManager from './app/AppManager'

let html = $('html')

console.log('Main file is loaded.')

if (html.hasClass('app')) {
  new AppManager()
} else if(html.hasClass('admin')) {
  new AdminManager()
}
