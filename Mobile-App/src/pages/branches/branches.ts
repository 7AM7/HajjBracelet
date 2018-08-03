import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { ProfilePage } from '../profile/profile';
import { RestProvider } from '../../providers/rest/rest';
/**
 * Generated class for the BranchesPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-branches',
  templateUrl: 'branches.html',
})
export class BranchesPage {
  BranchesTransaction: any[]=[];
  constructor(public navCtrl: NavController, public navParams: NavParams,public restProvider: RestProvider) {
    this.getStoresTransaction();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad BranchesPage');
  }

  goProfile(){
    this.navCtrl.push(ProfilePage);
  }
  doRefresh(refresher) {
    this.BranchesTransaction =[];
    console.log('Begin async operation', refresher);
    this.getStoresTransaction();
    setTimeout(() => {
      console.log('Async operation has ended');
      refresher.complete();
    }, 2000);
  }
  getStoresTransaction()
  {
    this.restProvider.getBranchesTransactions().then(data => {

        data['data'].forEach(element => {
          var branch = element['branch'];
          var dataa = { name: branch.name, 
            date:element['created_at'], 
            imgUrl: branch.image,
            amount:""+element['balance']
          };
          if(dataa.imgUrl == null)dataa.imgUrl  = "assets/imgs/logo.png";
          if(dataa.date == null)dataa.date = "2018-07-01 18:00::01";
          console.log(dataa);
          this.BranchesTransaction.push(dataa);
        });

      });
    // return this.BranchesTransaction = [
    //    { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
    //    { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
    //    { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
    //    { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
       
    //  ];
  }

}
