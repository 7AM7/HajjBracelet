import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { ProfilePage } from '../profile/profile';
import { PaymentPage } from '../payment/payment';
import { RestProvider } from '../../providers/rest/rest';
/**
 * Generated class for the RequestPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-request',
  templateUrl: 'request.html',
})
export class RequestPage {
  ItemId:string;
  userRequestTransaction: any[]=[];
  constructor(public restProvider: RestProvider,public navCtrl: NavController, public navParams: NavParams) {
    this.getRequestTransaction();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad RequestPage');
  }
  
  goProfile(){
    this.navCtrl.push(ProfilePage);
  }
  doRefresh(refresher) {
    this.userRequestTransaction =[];
    console.log('Begin async operation', refresher);
    this.getRequestTransaction();
    setTimeout(() => {
      console.log('Async operation has ended');
      refresher.complete();
    }, 2000);
  }
  getRequestTransaction()
  {
    this.restProvider.getRequestTransactions().then(data => {
      console.log(data);
        data['data'].forEach(element => {

          var branch = element['store'];
          var dataa = { 
            id :element['id'],
            name: branch.name, 
            date:element['created_at'], 
            imgUrl: branch.image,
            amount:""+element['balance']
          };
          if(dataa.imgUrl == null)dataa.imgUrl  = "assets/imgs/logo.png";
          if(dataa.date == null)dataa.date = "2018-07-01 18:00::01";
          console.log(dataa.id);
          this.userRequestTransaction.push(dataa);
        });

      });
  }
  openRequests(request)
  {
    this.navCtrl.push(PaymentPage,{ItemId:request.id,ItemImage:request.imgUrl,ItemName:request.name,ItemAmount:request.amount});
  }
}
