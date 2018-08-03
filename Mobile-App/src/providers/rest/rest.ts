import { HttpClient, } from '@angular/common/http';
import { RequestOptions} from '@angular/http';
import { Injectable } from '@angular/core';
import { Storage } from '@ionic/storage';

/*import { Storage } from '@ionic/storage';
  Generated class for the RestProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class RestProvider {
  token:any;
  apiUrl = 'http://beta.etwq3.com/api/v1';
  constructor(private storage: Storage,public http: HttpClient) {
    console.log('Hello RestProvider Provider');
  }

  login(country_code, mobile) {
      var data = {
        "country_code": country_code,
        "mobile": mobile
      };
      console.log(data);
      var header = { "headers": {"Content-Type": "application/json"} };

      return new Promise((resolve,reject) => {
        console.log(this.apiUrl+'/auth/login');
        this.http.post(this.apiUrl+'/auth/login',data,header).subscribe(data => {
          resolve(data);}, 
        err => {
          reject(err);
          });
        });

    }

    loginConfirm(country_code, mobile, code,device_id,fcm_token) {
      var data = {
        "country_code" : country_code,
        "mobile"	   : mobile,
        "code"		   : code,
        "device_id"	   : device_id,
        "fcm_token"    : "xxxxx"
      };
      console.log(data);

      var header = { "headers": {"Content-Type": "application/json", 
    } };
      return new Promise((resolve,reject) => {
        this.http.post(this.apiUrl+'/auth/login/confirmation',data,header).subscribe(data => {
          resolve(data);}, 
        err => {
          reject(err);
          });
        });

    }

    getStoresTransactions() {
      return new Promise((resolve,reject) => {
        this.storage.get('user').then((val) => {
         this.token = val['token'];
        
  
        var header = { "headers": {"Content-Type": "application/json", 
        'Authorization': 'Bearer ' + this.token, } };
  
        
        this.http.get(this.apiUrl+'/users/stores/transactions',header).subscribe(data => {
            console.log(data);
            resolve(data);}, 
        err => {
          reject(err);
          });
        });
      });
    }
      
    getBranchesTransactions() {
      return new Promise((resolve,reject) => {
      this.storage.get('user').then((val) => {
       this.token = val['token'];
      

      var header = { "headers": {"Content-Type": "application/json", 
      'Authorization': 'Bearer ' + this.token, } };

      
      this.http.get(this.apiUrl+'/users/branches/transactions',header).subscribe(data => {
          console.log(data);
          resolve(data);}, 
      err => {
        reject(err);
        });
      });
    });
    }  
      
    getRequestTransactions() {
      return new Promise((resolve,reject) => {
      this.storage.get('user').then((val) => {
       this.token = val['token'];
      

      var header = { "headers": {"Content-Type": "application/json", 
      'Authorization': 'Bearer ' + this.token, } };

      
      this.http.get(this.apiUrl+'/users/stores/transactions?status=PENDING',header).subscribe(data => {
          console.log(data);
          resolve(data);}, 
      err => {
        reject(err);
        });
      });
    });
      
    }  

    ConfirmCode(code,status="ACCEPTED",id) {
        return new Promise((resolve,reject) => {
        this.storage.get('user').then((val) => {
        this.token = val['token'];
        

        var header = { "headers": {"Content-Type": "application/json", 
        'Authorization': 'Bearer ' + this.token, } };

        var data = {
          "pin_code" : code,
          "status"   : status
        }
        this.http.put(this.apiUrl+'/users/stores/transactions/'+id+'/confirm',data,header).subscribe(data => {
            console.log(data);
            resolve(data);}, 
        err => {
          reject(err);
          });
        });
      });
    }  

    updataImage(image) {
      return new Promise((resolve,reject) => {
      this.storage.get('user').then((val) => {
      this.token = val['token'];
      

      var header = { "headers": {"Content-Type": "application/json", 
      'Authorization': 'Bearer ' + this.token, } };

      var data = {
        "image" : image,
      }
      this.http.put(this.apiUrl+'/users/image',data,header).subscribe(data => {
          console.log(data);
          resolve(data);}, 
      err => {
        reject(err);
        });
      });
    });
  } 
  
  updatePinCode(old_pin, new_pin) {
    return new Promise((resolve,reject) => {
    this.storage.get('user').then((val) => {
    this.token = val['token'];
    

    var header = { "headers": {"Content-Type": "application/json", 
    'Authorization': 'Bearer ' + this.token, } };

    var data = {
      "old_pin_code" : old_pin,
      "new_pin_code" : new_pin,
      "new_pin_code_2" : new_pin,
    }
    this.http.put(this.apiUrl+'/users/pincode',data,header).subscribe(data => {
        console.log(data);
        resolve(data);}, 
    err => {
      reject(err);
      });
    });
  });
} 
}
