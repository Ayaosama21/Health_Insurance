
import React , { Component} from "react";
import {Text,Picker,StyleSheet,View,TouchableOpacity} from "react-native";
import {CardSection,Button} from '../common';
import { Navigation } from 'react-native-navigation';
import PrescriptionView from './PrescriptionView';

class DepartmentPicker extends Component {

    state = {user: ''}

    GoToPrescriptionView = () => {
      Navigation.setRoot(Presc)
    }

    updateUser = (user) => {
        this.setState({user: user})
    }
    constructor(props) {
        super(props);
        this.handleClick = this.handleClick.bind(this);
    }
    handleClick() {
        console.log('Click happened');
        this.GoToPrescriptionView();
    }
   render(){
    return (
           <View style={styles.container}>
             <Picker selectedValue = {this.state.user} style={{ height: 50, width: 150 }} onValueChange = {this.updateUser}>
                 <Picker.Item label="المسالك البوليه" value="مسالك" />
                 <Picker.Item label="أنف وأذن وحنجرة" value="نف" />
                 <Picker.Item label="الروماتيزم و الأمراض المناعية" value="الروماتيزم" />
                 <Picker.Item label="العظام" value="العظام" />
                 <Picker.Item label="النساء" value="النساء" />
                 <Picker.Item label="الباطنة" value="الباطنة" />
                 <Picker.Item label="الاعصاب" value="الاعصاب" />
                 <Picker.Item label="علاج طبيعي" value="علاج طبيعي" />
                 <Picker.Item label="جراحة" value="جراحة" />
                 <Picker.Item label="أطفال" value="أطفال" />
                 <Picker.Item label="أسنان" value="أسنان" />
                 <Picker.Item label="جلدية" value="جلدية" />
                 <Picker.Item label="ممارس" value="ممارس" />
                 <Picker.Item label="قلب" value="قلب" />
                 <Picker.Item label="أمراض دم" value="أمراض دم" />
                 <Picker.Item label="أوعية دموية" value="أوعية دموية" />
                 <Picker.Item label="كبد" value="كبد" />
                 <Picker.Item label="كلي" value="كلي" />
                 <Picker.Item label="رمد" value="رمد" />
                 <Picker.Item label="الصدر" value="الصدر" />
            </Picker>
        <Text style = {styles.text}>{this.state.user}</Text>
        <CardSection>
          <Button onPress={() => this.handleClick()}>الروشتات</Button>
        </CardSection>            

    </View>
    )
    }
    }

    const PV = () => {
      return (
        <PrescriptionView/>
      );
    }

export default DepartmentPicker

const styles = StyleSheet.create({
  text: {
        fontSize: 30,
        alignSelf: 'center',
        color: 'red'
     },
  container: {
    flex: 1,
    paddingTop: 40,
    alignItems: "center"
  }
})



Navigation.registerComponent('DPICK', () => DepartmentPicker);
Navigation.registerComponent('PV', () => PV);
/*
Navigation.events().registerAppLaunchedListener(async () => {
  Navigation.setRoot({
    root: {
      stack: {
        children: [
          {
            component: {
              id: 'DPICK',
              name: 'DPICK'
            }
          }
        ]
      }
    }
  });
});
*/

//Navigation.registerComponent('DocList', () => DocList);

const Presc = {
    root: { stack : {
    children: [
      {
        component: {
          id: 'PV',
          name: 'PV',
          options: {
            topBar: {
              title: {
                text: ' الروشتات                               ',
                fontSize: 30
              },
              backButton: {
                visible: false,
                color: '#000000'
              },
            }
          }
        }
      }
    ]
  }}}