import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { TabsPage } from '../tabs/tabs';
import { AlertController } from 'ionic-angular';
/**
 * Generated class for the PaymentPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-payment',
  templateUrl: 'payment.html',
})
export class PaymentPage {
  testConfirmResult:string;
  testConfirmOpen:boolean;
  constructor(public navCtrl: NavController, public navParams: NavParams, private alertCtrl: AlertController) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad PaymentPage');
  }
  YesBtn()
  {
    let alert = this.alertCtrl.create({

      inputs: [
        {
          name: 'sCode',
          placeholder: 'Scure Code'
        },
      ],
      buttons: [
        {
          text: 'OK',
          role: 'OK',
          handler: data => {
            console.log("Payment maybe done ...");
            this.navCtrl.setRoot(TabsPage);
          }
        },

      ]
    });
    alert.present();
  }
  NoBtn(){
    this.navCtrl.setRoot(TabsPage);
  }
}
