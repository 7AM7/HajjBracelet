import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { AlertController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { RestProvider } from '../../providers/rest/rest';
import { ImagePicker } from '@ionic-native/image-picker';
import { Base64 } from '@ionic-native/base64';
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
  balance:string;
  name:string;
  national_id:string;
  image:string;
  imgPreview = 'assets/imgs/logo.png';
  response :any;
  qr_code:any;
  constructor(public restProvider: RestProvider,private imagePicker: ImagePicker,
    private base64: Base64,private storage: Storage,public navCtrl: NavController, public navParams: NavParams, private alertCtrl: AlertController) {
  }
  ionViewWillEnter() {
    this.getDetails();
  }

  EditPinCode(){
    let alert = this.alertCtrl.create({

      inputs: [
        {
          name: 'oldPin',
          id:"oldPin",
          placeholder: 'Old Pin Code'
          ,
        },
        {
          name: 'newPin',
          id:"newPin",
          placeholder: 'New Pin Code'
          ,
        },
        {
          name: 'ConfirmNewPin',
          id:"ConfirmNewPin",
          placeholder: 'Confirm New Pin Code'
          ,
        },
      ],
      buttons: [
        {
          text: 'Change',
          role: 'OK',
          handler: data => {
            var oldPin = document.getElementById('oldPin').value;
            var newPin = document.getElementById('newPin').value;
            var ConfirmNewPin = document.getElementById('ConfirmNewPin').value;
            if(oldPin == null || newPin == null || ConfirmNewPin == null)return false;
            if(newPin !== ConfirmNewPin) return false;

            this.restProvider.updatePinCode(oldPin,newPin).then(data => {
              this.response = data;
              if(this.response['isSuccess'] == true)
              {
                alert.dismiss();
                console.log(this.response);
               // this.imgPreview = results[i];
              }
            });
          }
        },

      ]
    });
    alert.present();
  }

  editimage() {
    let options = {
      maximumImagesCount: 1
    };
    this.imagePicker.getPictures(options).then((results) => {
      for (var i = 0; i < results.length; i++) {
          this.imgPreview = results[i];
          this.base64.encodeFile(results[i]).then((base64File: string) => {
            this.restProvider.updataImage(base64File).then(data => {
              this.response = data;
              if(this.response['isSuccess'] == true)
              {
                console.log(this.response);
               // this.imgPreview = results[i];
              }
              
            });
          }, (err) => {
            console.log(err);
          });
      }
    }, (err) => { });
  }
  getDetails(){
    this.storage.get('user').then((val) => {
      this.balance = val['client'].balance;
      this.name = val['name'];
      this.qr_code = val['client'].qr_code;
      this.image = val['image'];
      this.national_id = val['client'].national_id;
      console.log(this.balance,this.name,this.national_id);
    });
  }
  goQR(){
    console.log(this.qr_code);
    let alert = this.alertCtrl.create();
    alert.setTitle('Your QR-Code');
    alert.setCssClass('alertt')
    alert.setMessage('<img  class="" src="'+this.qr_code+'"/> </br> <h3>ID: 7782</h3>');
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
