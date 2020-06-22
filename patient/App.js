import React,{useState} from "react";
import {Picker,ScrollView,Text,StyleSheet,View,Button} from 'react-native';
import {StackNavigator} from 'react-navigation';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';

function diseaesList({navigation}){
    /*static navigationOptions =
    {
        title: 'MainActivity',
    };*/
 /*   NavigateActivityFunction = () =>
    {
        this.props.navigation.navigate('Second');
    }
*/
    const [selectedValue, setSelectedValue] = useState("اختار القسم");
    return (<div>
        <View style={styles.container}><Picker selectedValue={selectedValue} style={{ height: 50, width: 150 }} onValueChange={(itemValue, itemIndex) => setSelectedValue(itemValue)}>
                <Picker.Item label="المسالك البوليه" value="مسالك" />
                <Picker.Item label="أنف وأذن وحنجرة" value="نف" />
                <Picker.Item label="أسنان" value="أسنان" />
                <Picker.Item label="الروماتيزم و الأمراض المناعية" value="الروماتيزم" />
                <Picker.Item label="العظام" value="العظام" />
                <Picker.Item label="النساء" value="النساء" />
                <Picker.Item label="الباطنة" value="الباطنة" />
                <Picker.Item label="الاعصاب" value="الاعصاب" />
                <Picker.Item label="علاج طبيعي" value="علاج طبيعي" />
                <Picker.Item label="جراحة" value="جراحة" />
                <Picker.Item label="أطفال" value="أطفال" />
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
    </View>
          <View style={styles.buttonContainer}>
                      <Button onPress={()=> navigation.navigate('image')} title='الروشتات'/>
          </View>
           </div>
    );
    }
    function image ({navigation})
    {
        return(
                <ScrollView style={styles.scroll}>
                    <View style={styles.container}>
                        <Image
                            source={require('./1.png')}
                            style={{width:400,height:450}}
                         />
                        <Image
                            source={require('./2.png')}
                                  style={{ width: 400, height: 450, margin: 16 }}
                        />
                        <Image
                            source={require('./3.png')}
                            style={{ width: 400, height: 450, margin: 16 }}
                        />
                        <Image
                            source={require('./4.png')}
                            style={{ width: 400, height: 450, margin: 16 }}
                        />
                        <Image
                            source={require('./5.png')}
                            style={{ width: 400, height: 450, margin: 16 }}
                        />
                        <Image
                            source={require('./6.png')}
                            style={{ width: 400, height: 450, margin: 16 }}
                        />
                        <Image
                            source={require('./7.png')}
                            style={{ width: 400, height: 450, margin: 16 }}
                        />
                        <Image
                             source={require('./8.png')}
                             style={{ width: 400, height: 450, margin: 16 }}
                        />
                        <Image
                             source={require('./9.png')}
                             style={{ width: 400, height: 450, margin: 16 }}
                        />
                    </View>
                </ScrollView>
                 );
    }

const Stack = createStackNavigator();

function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Diseaes">
        <Stack.Screen name="Diseaes" component={diseaesList} />
        <Stack.Screen name="Image" component={image} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    paddingTop: 40,
    alignItems: "center"
  },
     /*buttonContainer: {
               flex: 1,
               alignSelf: 'stretch',
               backgroundColor: '#fff',
               borderRadius: 5,
               borderWidth: 1,
               borderColor: '#007aff',
               marginLeft: 5,
               marginRight: 5,
               textAlign: 'center',
               color:'#007aff',
               fontSize: 16,
               fontWeight:'600',
               paddingTop: 10,
               paddingBottom:10
       },*/
});

export default App;