import React, { useState, useEffect } from "react";
import {
  View,
  Text,
  ImageBackground,
  TouchableOpacity,
  Image,
  StyleSheet,
  ScrollView,
  Platform,
} from "react-native";
import { ProgressBar } from "../components";
import { COLORS, SIZES, FONTS, icons } from "../constants";
import LinearGradient from "react-native-linear-gradient";

const MovieDetail = ({ navigation, route }) => {
  const [selectedMovie, setSelectedMovie] = useState(null);

  // useEffect(() => {
  //   let { selectedMovie } = route.params;
  //   setSelectedMovie(selectedMovie);
  // }, []);

  function renderHeaderBar() {
    return (
      <View
        style={{
          flexDirection: "row",
          justifyContent: "space-between",
          alignItems: "center",
          marginTop: Platform.OS === "ios" ? 40 : 20,
          paddingHorizontal: SIZES.padding,
        }}
      >
        {/* Back */}
        <TouchableOpacity
          style={{
            alignItems: "center",
            justifyContent: "center",
            width: 50,
            height: 50,
            borderRadius: 20,
            backgroundColor: COLORS.transparentBlack,
          }}
          onPress={() => navigation.goBack()}
        >
          <Image
            source={icons.left_arrow}
            style={{ width: 20, height: 20, tintColor: COLORS.white }}
          />
        </TouchableOpacity>

        {/* Share */}
        <TouchableOpacity
          style={{
            alignItems: "center",
            justifyContent: "center",
            width: 50,
            height: 50,
            borderRadius: 20,
            backgroundColor: COLORS.transparentBlack,
          }}
          onPress={() => console.log("Share")}
        >
          <Image
            source={icons.favorite}
            style={{ width: 20, height: 20, tintColor: COLORS.white }}
          />
        </TouchableOpacity>
      </View>
    );
  }

  function renderHeaderSection() {
    return (
      <ImageBackground
        source={require("../assets/images/series/barbarians/barbarians_cover.jpg")}
        resizeMode="cover"
        style={{
          width: "100%",
          height: SIZES.height < 700 ? SIZES.height * 0.6 : SIZES.height * 0.7,
        }}
      >
        <View style={{ flex: 1 }}>
          {renderHeaderBar()}

          <View style={{ flex: 1, justifyContent: "center" }}>
            <LinearGradient
              start={{ x: 0, y: 0 }}
              end={{ x: 0, y: 1 }}
              colors={["transparent", "#000"]}
              style={{
                width: "100%",
                height: "100%",
                alignItems: "center",
                justifyContent: "flex-end",
              }}
            >
              {/* Name */}
              <Text
                style={{
                  marginTop: SIZES.base,
                  color: COLORS.white,
                  ...FONTS.h1,
                }}
              >
                Pijar TV
              </Text>
            </LinearGradient>
          </View>
        </View>
      </ImageBackground>
    );
  }

  function renderMovieDetails() {
    return (
      <View
        style={{
          flex: 1,
          paddingHorizontal: SIZES.padding,
          marginTop: SIZES.padding,
          justifyContent: "space-around",
        }}
      >
        {/* Watch */}
        <TouchableOpacity
          style={{
            height: 60,
            alignItems: "center",
            justifyContent: "center",
            marginBottom: Platform.OS === "ios" ? SIZES.padding * 2 : 0,
            borderRadius: 15,
            backgroundColor: COLORS.primary,
          }}
          onPress={() => navigation.navigate("PlayScreen")}
        >
          <Text style={{ color: COLORS.white, ...FONTS.h2 }}>
            {selectedMovie?.details?.progress == "0%"
              ? "WATCH NOW"
              : "CONTINUE WATCHING"}
          </Text>
        </TouchableOpacity>
      </View>
    );
  }

  return (
    <ScrollView
      contentContainerStyle={{ flex: 1, backgroundColor: COLORS.black }}
      style={{ backgroundColor: COLORS.black }}
    >
      {/* Header */}
      {renderHeaderSection()}

      {/* Category & Ratings */}

      {/* Movie Details */}
      {renderMovieDetails()}
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  categoryContainer: {
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "center",
    marginLeft: SIZES.base,
    paddingHorizontal: SIZES.base,
    paddingVertical: 3,
    borderRadius: SIZES.base,
    backgroundColor: COLORS.gray1,
  },
});

export default MovieDetail;
