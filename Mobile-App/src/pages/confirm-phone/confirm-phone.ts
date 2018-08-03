import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { TabsPage } from '../tabs/tabs';
import { RestProvider } from '../../providers/rest/rest';
import { UniqueDeviceID } from '@ionic-native/unique-device-id';
import { Storage } from '@ionic/storage';
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
  response: any;
  mobile:string;
  country_code:string;
  code:string;
  DeviceID:any;
  message:string;
  users : any;
  constructor(private storage: Storage,private uniqueDeviceID: UniqueDeviceID,public navCtrl: NavController, public navParams: NavParams, public restProvider: RestProvider) {
    this.uniqueDeviceID.get()
    .then((uuid: any) => this.DeviceID =  uuid  )
    .catch((error: any) => console.log(error));
    console.log(this.DeviceID);
    this.country_code = navParams.get('country_code');
    this.mobile = navParams.get('mobile');
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ConfirmPhonePage');
  }
  goHomePage(code){


    if(this.country_code== null || this.mobile==null || code == null) return false;
    this.DeviceID = "00000";
    this.restProvider.loginConfirm(this.country_code, this.mobile,code,this.DeviceID,null).then(data => {
      this.response = data;
      if(this.response['isSuccess'] == true){
        console.log( this.response['user']);
        this.storage.set('user', this.response['user']); 
        this.navCtrl.setRoot(TabsPage);
      }
    }).catch((err) => {
      console.log(err['error'].message);
      this.message = err['error'].message;
     });
  }

}
