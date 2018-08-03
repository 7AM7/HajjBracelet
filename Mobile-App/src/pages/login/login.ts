import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { ConfirmPhonePage } from '../confirm-phone/confirm-phone';
import { RestProvider } from '../../providers/rest/rest';
/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {
  response: any;
  message:string;
  mobile:string;
  country_code:string;
  constructor(public navCtrl: NavController, public navParams: NavParams, public restProvider: RestProvider) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
  }
  ConfrimPhone(country_code='+20', mobile){
    if(country_code== null || mobile==null) return false;
    this.restProvider.login(country_code, mobile).then(data => {
      this.response = data;
      if(this.response['isSuccess'] == true){
        this.navCtrl.setRoot(ConfirmPhonePage,{country_code:country_code,mobile:mobile });
      }

    }).catch((err) => {
     console.log(err['error'].message);
     this.message = err['error'].message;
    });
  }
}
