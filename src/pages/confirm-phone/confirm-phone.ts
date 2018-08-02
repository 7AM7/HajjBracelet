import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { TabsPage } from '../tabs/tabs';
/**
 * Generated class for the ConfirmPhonePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-confirm-phone',
  templateUrl: 'confirm-phone.html',
})
export class ConfirmPhonePage {

  constructor(public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ConfirmPhonePage');
  }
  goHomePage(){
    this.navCtrl.setRoot(TabsPage);
  }
}
