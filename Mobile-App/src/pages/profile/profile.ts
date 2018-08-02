import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { AlertController } from 'ionic-angular';
/**
 * Generated class for the ProfilePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-profile',
  templateUrl: 'profile.html',
})
export class ProfilePage {
  testConfirmResult:string;
  testConfirmOpen:boolean;
  constructor(public navCtrl: NavController, public navParams: NavParams, private alertCtrl: AlertController) {
  }
  goQR(){
    let alert = this.alertCtrl.create();
    alert.setTitle('Your QR-Code');
    alert.setCssClass('alertt')
    alert.setMessage('<img  class="circle-pic" src="https://images-na.ssl-images-amazon.com/images/I/41xi-Aee9OL._SL500_AC_SS350_.jpg"/> </br> <h3>ID: 7782</h3>');
    alert.addButton({
      text: 'Cancel',
      role: 'cancel',
      cssClass: 'secondary',
      handler: () => {
        console.log('Confirm Cancel');
        this.testConfirmResult = 'Cancel';
        this.testConfirmOpen = false;
      }
    });
    alert.addButton({
      text: 'Okay',
      handler: () => {
        console.log('Confirm Ok');
        this.testConfirmResult = 'Ok';
        this.testConfirmOpen = false;
      }
    });

    alert.present(alert).then(() => {
      this.testConfirmOpen = true;
    });
  }
  ionViewDidLoad() {
    console.log('ionViewDidLoad ProfilePage');
  }


}
