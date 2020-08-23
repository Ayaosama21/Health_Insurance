import React, {Component} from 'react';
import {ScrollView} from 'react-native';
import axios from 'axios';
import SoloDetails from './SoloDetails';

class SoloList extends Component {
    state = { lists: [] };


    componentWillMount() {
        axios.get('https://rallycoding.herokuapp.com/api/music_albums')
            .then(response => this.setState({ lists: response.data}));
    }
//NEED TO CHAAAANGE
    renderAlbums() {
        return this.state.lists.map(obje => 
            <SoloDetails key={obje.title} obje={obje} />
        );
    }

    render() {
        console.log(this.state);
        return (
            <ScrollView>
                {this.renderAlbums()}
            </ScrollView>
        );
    }
}

export default SoloList;
/*
import React, {Component} from 'react';
import {ScrollView} from 'react-native';
import axios from 'axios';
import AlbumDetails from './AlbumDetails';

class SoloList extends Component {
    state = { lists: [] };


    componentWillMount() {
        axios.get('https://rallycoding.herokuapp.com/api/music_albums')
            .then(response => this.setState({ lists: response.data}));
    }
//NEED TO CHAAAANGE
    renderAlbums() {
        return this.state.lists.map(album => 
            <AlbumDetails key={album.title} album={album} />
        );
    }

    render() {
        console.log(this.state);
        return (
            <ScrollView>
                {this.renderAlbums()}
            </ScrollView>
        );
    }
}

export default SoloList;

*/