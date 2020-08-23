import React from 'react';
import { Text, View } from 'react-native';
import {Card, CardSection, Button} from '../common';

const DoctorSelectDetails = ({ patient }) => {
  const { id, username, gender } = patient;
  const {
    thumbnailStyle,
    headerContentStyle,
    ContainerStyle,
    headerTextStyle,
    imageStyle
  } = styles;

  const onButtonPress = () =>{

  }

  const doctorSelect = (x) => {
    return  <Button>
              {x}
            </Button>
  }
/*
  const doctorSelect = () => {
    return  <Button onPress={onButtonPress.bind(this)}>
              {username}
            </Button>
  }
*/

  return (
    <Card>
      <CardSection>
        <View style={ContainerStyle}>
          <doctorSelect x = {username}/>
        </View>
      </CardSection>
    </Card>
  );
};

const styles = {
  headerContentStyle: {
    flexDirection: 'column',
    justifyContent: 'space-around'
  },
  headerTextStyle: {
    fontSize: 18
  },
  thumbnailStyle: {
    height: 50,
    width: 50
  },
  ContainerStyle: {
    justifyContent: 'center',
    alignItems: 'center',
    marginLeft: 10,
    marginRight: 10,
    flex: 1
  },
  imageStyle: {
    height: 300,
    flex: 1,
    width: null
  }
};

export default DoctorSelectDetails;