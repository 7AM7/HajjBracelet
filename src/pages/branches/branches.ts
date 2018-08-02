import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { ProfilePage } from '../profile/profile';
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
  BranchesTransaction: Array<{name:string,date:string,imgUrl: string,amount:string}>;
  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.getStoresTransaction();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad BranchesPage');
  }

  goProfile(){
    this.navCtrl.push(ProfilePage);
  }

  getStoresTransaction()
  {
    return this.BranchesTransaction = [
       { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
       { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
       { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
       { name: "E-Wallet", date:"2018-07-01 18:00::01", imgUrl: "assets/imgs/logo.png",amount:"50$"},
       
     ];
  }

}
