import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { TabsPage } from '../tabs/tabs';
import { StoresPage } from '../stores/stores';
import { AlertController } from 'ionic-angular';
import { RestProvider } from '../../providers/rest/rest';
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
  ItemId:string;
  ItemName:string;
  ItemImage:string;
  ItemAmount:string;
  code:string;
  response:any;
  constructor(public restProvider: RestProvider,public navCtrl: NavController, public navParams: NavParams, private alertCtrl: AlertController) {
    this.ItemId = navParams.get('ItemId');
    this.ItemName = navParams.get('ItemName');
    this.ItemImage = navParams.get('ItemImage');
    this.ItemAmount = navParams.get('ItemAmount');
    console.log(this.ItemId );
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
          id:"sCodee",
          placeholder: 'Scure Code'
          ,
        },
      ],
      buttons: [
        {
          text: 'OK',
          role: 'OK',
          handler: data => {
            var code1=document.getElementById('sCodee').value;
            console.log(code1);
            this.ConfirmCode(code1);
      
          }
        },

      ]
    });
    alert.present();
  }
  ConfirmCode(code)
  {
    console.log(this.ItemId);
    if(code== null || this.ItemId==null ) return false;

    this.restProvider.ConfirmCode(code,"ACCEPTED",this.ItemId).then(data => {
      this.response = data;
      console.log(data);
      if(this.response['isSuccess'] == true)
      {
        this.navCtrl.setRoot(StoresPage);
      }
      console.log(this.response);
    });
  }
  NoBtn(){
    this.navCtrl.setRoot(StoresPage);
  }
}
